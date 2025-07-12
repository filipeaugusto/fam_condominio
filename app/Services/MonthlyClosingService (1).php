<?php

namespace App\Services;

use App\Models\Condominium;
use App\Models\Expense;
use App\Models\MonthlyClosing;
use App\Models\ApartmentClosingCharge;
use App\Models\ConsumptionCharge;
use App\Enums\ExpenseType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MonthlyClosingService
{
    public function fechar(Condominium $condominium, string $reference): MonthlyClosing
    {
        return DB::transaction(function () use ($condominium, $reference) {
            $refDate = Carbon::parse($reference)->startOfMonth();

            // Reverter fechamento existente
            $existing = MonthlyClosing::where('condominium_id', $condominium->id)
                ->where('reference', $refDate)
                ->first();

            if ($existing) {
                Expense::where('monthly_closing_id', $existing->id)->update([
                    'included_in_closing' => false,
                    'monthly_closing_id' => null,
                ]);

                $existing->apartmentCharges()->delete();
                $existing->delete();
            }

            $apartments = $condominium->apartments;
            $totalApartments = $apartments->count();
            if ($totalApartments === 0) {
                throw new \Exception("O condomínio não possui apartamentos cadastrados.");
            }

            $totals = [];
            foreach (ExpenseType::cases() as $type) {
                $totals[$type->value] = Expense::where('condominium_id', $condominium->id)
                    ->where('type', $type->value)
                    ->where('included_in_closing', false)
                    ->sum('amount');
            }

            $totalAmount = array_sum($totals);

            $monthlyClosing = MonthlyClosing::create([
                'condominium_id' => $condominium->id,
                'reference' => $refDate,
                'total_fixed_expenses' => $totals[ExpenseType::FIXED->value],
                'total_variable_expenses' => $totals[ExpenseType::VARIABLE->value],
                'total_reserve_expenses' => $totals[ExpenseType::RESERVE->value],
                'total_emergency_expenses' => $totals[ExpenseType::EMERGENCY->value],
                'total_amount' => $totalAmount,
            ]);

            // Marcar despesas incluídas no fechamento
            Expense::where('condominium_id', $condominium->id)
                ->whereIn('type', ExpenseType::values())
                ->where('included_in_closing', false)
                ->update([
                    'included_in_closing' => true,
                    'monthly_closing_id' => $monthlyClosing->id,
                ]);

            // Cálculo proporcional para tipo variável
            $consumptions = ConsumptionCharge::where('condominium_id', $condominium->id)
                ->where('reference', $refDate)
                ->get()
                ->keyBy('apartment_id');

            $totalVariable = $totals[ExpenseType::VARIABLE->value];
            $totalConsumo = $consumptions->sum(function ($c) {
                return $c->current_reading - $c->previous_reading;
            });

            foreach ($apartments as $apartment) {
                $total = 0;

                // FIXED, RESERVE, EMERGENCY — rateio igualitário
                $total += round($totals[ExpenseType::FIXED->value] / $totalApartments, 2);
                $total += round($totals[ExpenseType::RESERVE->value] / $totalApartments, 2);
                $total += round($totals[ExpenseType::EMERGENCY->value] / $totalApartments, 2);

                // VARIABLE — proporcional ao consumo
                $consumo = 0;
                if ($consumptions->has($apartment->id)) {
                    $c = $consumptions->get($apartment->id);
                    $consumo = $c->current_reading - $c->previous_reading;
                }

                $proporcao = $totalConsumo > 0 ? $consumo / $totalConsumo : 0;
                $total += round($totalVariable * $proporcao, 2);

                ApartmentClosingCharge::create([
                    'monthly_closing_id' => $monthlyClosing->id,
                    'apartment_id' => $apartment->id,
                    'amount' => $total,
                ]);
            }

            return $monthlyClosing;
        });
    }
}
