<?php

namespace App\Services;

use App\Enums\ExpenseType;
use App\Models\Condominium;
use App\Models\Expense;
use App\Models\MonthlyClosing;
use App\Models\MonthlyClosingApartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MonthlyClosingService
{
    public function fechar(Condominium $condominium, string $reference): MonthlyClosing
    {
        return DB::transaction(function () use ($condominium, $reference) {

            // Data de referência como o último dia do mês
            $refDate = Carbon::parse($reference)
                ->endOfMonth()
                ->toDateString();

            // Reversão de fechamento existente
            $existing = MonthlyClosing::where('condominium_id', $condominium->id)
                ->where('reference', $refDate)
                ->first();

            if ($existing) {
                Expense::where('monthly_closing_id', $existing->id)->update([
                    'included_in_closing' => false,
                    'monthly_closing_id' => null,
                ]);
                $existing->delete();
            }

            $apartments = $condominium->apartments;
            $totalApartments = $apartments->count();

            if ($totalApartments === 0) {
                throw new \Exception("O condomínio não possui apartamentos cadastrados.");
            }

            // Cálculo por tipo de despesa
            $types = ExpenseType::values();
            $totals = [];

            foreach ($types as $type) {
                $totals[$type] = Expense::where('condominium_id', $condominium->id)
                    ->where('type', $type)
                    ->where('included_in_closing', false)
                    ->where('due_date', '<=', $refDate)
                    ->sum('amount');
            }

            $totalAmount = array_sum($totals);

            // Criar fechamento mensal
            $monthlyClosing = MonthlyClosing::create([
                'condominium_id' => $condominium->id,
                'reference' => $refDate,
                'total_fixed' => $totals['fixed'],
                'total_variable' => $totals['variable'],
                'total_reserve' => $totals['reserve'],
                'total_emergency' => $totals['emergency'],
                'total_amount' => $totalAmount,
            ]);

            $totalAmount -= $totals['variable'];

            // Criar rateios por apartamento
            foreach ($apartments as $apartment) {
                MonthlyClosingApartment::create([
                    'monthly_closing_id' => $monthlyClosing->id,
                    'apartment_id' => $apartment->id,
                    'amount' => round($totalAmount / $totalApartments, 2),
                ]);
            }

            $consumptionService = app(ConsumptionService::class);
            $expenses = Expense::where('condominium_id', $condominium->id)
                ->where('included_in_closing', false)
                ->where('due_date', '<=', $refDate)
                ->get();

            foreach ($expenses as $expense) {
                // Marcar despesas como incluídas
                $expense->update([
                    'included_in_closing' => true,
                    'monthly_closing_id' => $monthlyClosing->id,
                ]);

                if ($expense->type === ExpenseType::VARIABLE) {
                    // Calcular rateio por consumo
                    $consumptionService->calculate($expense, $monthlyClosing->id);
                }
            }

            return $monthlyClosing;
        });
    }
}
