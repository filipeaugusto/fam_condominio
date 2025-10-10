<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\ConsumptionCharge;
use App\Models\MonthlyClosingApartment;
use Illuminate\Support\Facades\DB;

class ConsumptionService
{
    /**
     * Calcula e aplica o rateio de despesas variáveis por consumo.
     *
     * @param  Expense  $expense
     * @param  int|null  $monthlyClosingId
     * @return array
     */
    public function calculate(Expense $expense, ?int $monthlyClosingId = null): array
    {
        $charges = ConsumptionCharge::where('expense_id', $expense->id)->get();

        if ($charges->isEmpty()) {
            return [
                'status' => 'warning',
                'message' => 'Nenhum lançamento de consumo encontrado para esta despesa.',
            ];
        }

        $totalConsumption = $charges->sum('consumption');
        $result = [];

        DB::transaction(function () use ($charges, $expense, $totalConsumption, $monthlyClosingId, &$result) {
            // Caso o consumo total seja zero, divide igualmente
            if ($totalConsumption <= 0) {
                $this->applyEqualDivision($charges, $expense, $monthlyClosingId, $result);
                return;
            }

            $unitCost = $expense->amount / $totalConsumption;

            foreach ($charges as $charge) {
                $apartmentAmount = round($charge->consumption * $unitCost, 2);

                $charge->update([
                    'unit_cost' => round($unitCost, 2),
                    'total_amount' => $apartmentAmount,
                    'service_class' => $expense->service_class,
                ]);

                if ($monthlyClosingId) {
                    MonthlyClosingApartment::updateOrCreate(
                        [
                            'monthly_closing_id' => $monthlyClosingId,
                            'apartment_id' => $charge->apartment_id,
                        ],
                        ['amount' => DB::raw("amount + {$apartmentAmount}")] // Acumula valores se já existir
                    );
                }

                $result[] = [
                    'apartment_id' => $charge->apartment_id,
                    'consumption' => $charge->consumption,
                    'amount' => $apartmentAmount,
                ];
            }
        });

        return [
            'status' => 'success',
            'message' => 'Rateio de consumo aplicado com sucesso.',
            'data' => $result,
        ];
    }

    /**
     * Divide o valor igualmente entre os apartamentos.
     */
    protected function applyEqualDivision($charges, $expense, $monthlyClosingId, &$result)
    {
        $count = $charges->count();
        $equalAmount = round($expense->amount / max($count, 1), 2);

        foreach ($charges as $charge) {
            $charge->update([
                'unit_cost' => 0,
                'total_amount' => $equalAmount,
                'service_class' => $expense->service_class,
            ]);

            if ($monthlyClosingId) {
                MonthlyClosingApartment::updateOrCreate(
                    [
                        'monthly_closing_id' => $monthlyClosingId,
                        'apartment_id' => $charge->apartment_id,
                    ],
                    ['amount' => DB::raw("amount + {$equalAmount}")] // Acumula valores se já existir
                );
            }

            $result[] = [
                'apartment_id' => $charge->apartment_id,
                'consumption' => 0,
                'amount' => $equalAmount,
            ];
        }
    }
}
