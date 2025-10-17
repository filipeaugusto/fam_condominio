<?php

namespace App\Console\Commands;

use App\Models\Condominium;
use App\Services\MonthlyClosingService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class MonthlyClosingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expenses:monthly-closing {condominium_id} {--reference=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realiza o fechamento mensal das despesas variáveis de um condomínio';


    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $condominiumId = $this->argument('condominium_id');
        $reference = $this->option('reference') ?? now()->format('Y-m-d');

        $condominium = Condominium::find($condominiumId);

        if (! $condominium) {
            $this->error("Condomínio não encontrado.");
            return CommandAlias::FAILURE;
        }

        try {
            $service = new MonthlyClosingService();
            $fechamento = $service->fechar($condominium, $reference);

            $this->info("✅ Fechamento mensal realizado com sucesso!");
            $this->line("📅 Referência: {$fechamento->reference}");
            $this->line("💰 Total rateado: R$ " . number_format($fechamento->total_amount, 2, ',', '.'));
            $this->line("🏢 Condomínio: {$condominium->name}");

            return CommandAlias::SUCCESS;

        } catch (\Exception $e) {
            $this->error("Erro: " . $e->getMessage());
            return CommandAlias::FAILURE;
        }
    }
}
