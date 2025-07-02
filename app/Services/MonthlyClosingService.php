<?php

namespace App\Services;

use App\Models\Condominium;
use App\Models\Expense;
use App\Models\MonthlyClosing;
use App\Models\MonthlyClosingApartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MonthlyClosingService
{
    /**
     * @param Condominium $condominium
     * @param string $reference
     * @return MonthlyClosing
     */
    public function fechar(Condominium $condominium, string $reference): MonthlyClosing
    {
        return DB::transaction(function () use ($condominium, $reference) {

            // Coletar despesas variáveis não incluídas ainda
            $expenses = Expense::where('condominium_id', $condominium->id)
                ->where('type', 'variable')
                ->where('included_in_closing', false)
                ->get();

//            dd($expenses);

            if ($expenses->isEmpty()) {
                throw new \Exception("Nenhuma despesa variável disponível para fechamento.");
            }

            // Coletar apartamentos ativos
            $apartments = $condominium->apartments;
            $totalApartments = $apartments->count();

            if ($totalApartments === 0) {
                throw new \Exception("O condomínio não possui apartamentos cadastrados.");
            }

            // Calcular totais
            $totalVariable = $expenses->sum('amount');
            $rateioPorApartamento = round($totalVariable / $totalApartments, 2);

            // Criar o registro de fechamento mensal
            $monthlyClosing = MonthlyClosing::create([
                'condominium_id' => $condominium->id,
                'reference' => Carbon::parse($reference)->startOfMonth(),
                'total_variable_expenses' => $totalVariable,
                'total_amount' => $totalVariable,
            ]);

            // Marcar despesas como fechadas e associar ao fechamento
            foreach ($expenses as $expense) {
                $expense->update([
                    'included_in_closing' => true,
                    'monthly_closing_id' => $monthlyClosing->id,
                ]);
            }

            // Gerar rateio por apartamento
            foreach ($apartments as $apartment) {
                MonthlyClosingApartment::create([
                    'monthly_closing_id' => $monthlyClosing->id,
                    'apartment_id' => $apartment->id,
                    'amount' => $rateioPorApartamento,
                ]);
            }

            return $monthlyClosing;
        });
    }
}
