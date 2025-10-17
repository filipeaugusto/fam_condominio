<?php

namespace App\Console\Commands;

use App\Enums\ExpenseService;
use App\Enums\ExpenseType;
use App\Models\Condominium;
use App\Models\MonthlyClosing;
use Illuminate\Console\Command;
use App\Models\Expense;
use Carbon\Carbon;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CloneFixedExpenses extends Command
{
    protected $signature = 'expenses:clone-fixed {condominium_id}';
    protected $description = 'Clona despesas fixas do mês anterior para o mês atual';

    public function handle(): int
    {
        $condominiumId = $this->argument('condominium_id');
        $condominium = Condominium::find($condominiumId);

        if (! $condominium) {
            $this->error("Condomínio não encontrado.");
            return CommandAlias::FAILURE;
        }

        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        $this->info("Buscando despesas fixas entre {$lastMonthStart->toDateString()} e {$lastMonthEnd->toDateString()}");

        $monthlyClosing = MonthlyClosing::where('reference', $lastMonthEnd->toDateString())
            ->where('condominium_id', $condominium->id)
            ->first();

        $fixedExpenses = Expense::whereIn('type', [ExpenseType::from('fixed'), ExpenseType::from('reserve')])
            ->where('included_in_closing', true)
            ->where('monthly_closing_id', $monthlyClosing ? $monthlyClosing->id : null)
            ->get();

        foreach ($fixedExpenses as $expense) {
            // Clona para o mês atual
            Expense::updateOrCreate(
                [
                    'condominium_id' => $expense->condominium_id,
                    'type' => $expense->type,
                    'service_class' => $expense->service_class,
                    'label' => $expense->label,
                    'due_date' => Carbon::now()->startOfMonth()->addDays($expense->due_date->day - 1),
                    'included_in_closing' => false,
                ],
                [
                    'condominium_id' => $expense->condominium_id,
                    'type' => $expense->type,
                    'service_class' => $expense->service_class,
                    'label' => $expense->label,
                    'amount' => $expense->service_class == ExpenseService::from('not_apply') ? $expense->amount : 0,
                    'due_date' => Carbon::now()->startOfMonth()->addDays($expense->due_date->day - 1),
                    'included_in_closing' => false,
                ]
            );
        }

        $this->line("🏢 Condomínio: {$condominium->name}");
        $this->info("✅ {$fixedExpenses->count()} despesas fixas clonadas para o mês atual.");

        return CommandAlias::SUCCESS;
    }
}
