<?php

namespace App\Services;

use App\Models\Condominium;
use App\Models\Expense;
use App\Models\MonthlyClosing;
use App\Models\ApartmentClosingCharge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MonthlyClosingService
{
    public function fechar(Condominium $condominium, string $reference): MonthlyClosing
    {
        return DB::transaction(function () use ($condominium, $reference) {
            $refDate = Carbon::parse($reference)->startOfMonth();

            // Reversão de fechamento existente
            $existing = MonthlyClosing::where('condominium_id', $condominium->id)
                ->where('reference', $refDate)
                ->first();

            if ($existing) {
                Expense::where('monthly_closing_id', $existing->id)->update([
                    'included_in_closing' => false,
                    'monthly_cling_id' => null,
                ]);

                $existing->apartmentCharges()->delete();
                $existing->delete();
            }

            $apartments = $condominium->apartments;
            $totalApartments = $apartments->count();

            if ($totalApartments === 0) {
                throw new \Exception("O condomínio não possui apartamentos cadastrados.");
            }

            // Cálculo por tipo de despesa
            $types = ['fixed', 'variable', 'reserve', 'emergency'];
            $totals = [];

            foreach ($types as $type) {
                $totals[$type] = Expense::where('condominium_id', $condominium->id)
                    ->where('type', $type)
                    ->where('included_in_closing', false)
                    ->sum('amount');
            }

            $totalAmount = array_sum($totals);

            // Criar fechamento mensal
            $monthlyClosing = MonthlyClosing::create([
                'condominium_id' => $condominium->id,
                'reference' => $refDate,
                'total_fixed_expenses' => $totals['fixed'],
                'total_variable_expenses' => $totals['variable'],
                'total_reserve_expenses' => $totals['reserve'],
                'total_emergency_expenses' => $totals['emergency'],
                'total_amount' => $totalAmount,
            ]);

            // Marcar despesas como incluídas
            Expense::where('condominium_id', $condominium->id)
                ->whereIn('type', $types)
                ->where('included_in_closing', false)
                ->update([
                    'included_in_closing' => true,
                    'monthly_closing_id' => $monthlyClosing->id,
                ]);

            // Criar rateios por apartamento
            foreach ($apartments as $apartment) {
                $amount =
                    round($totals['fixed'] / $totalApartments, 2) +
                    round($totals['variable'] / $totalApartments, 2) +
                    round($totals['reserve'] / $totalApartments, 2) +
                    round($totals['emergency'] / $totalApartments, 2);

                ApartmentClosingCharge::create([
                    'monthly_closing_id' => $monthlyClosing->id,
                    'apartment_id' => $apartment->id,
                    'amount' => $amount,
                ]);
            }

            return $monthlyClosing;
        });
    }
}
