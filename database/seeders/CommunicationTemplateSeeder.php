<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunicationTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('communication_templates')->insert([
            [
                'name' => 'Modelo para consumo/medição (ex: gás, água, energia, fundo de reserva, etc.)',
                'slug' => 'consumo',
                'content' => "📒 Prezados(as), bom dia.\n
Segue a medição de consumo de gás com o valor de rateio por apartamento.\n
Este valor será adicionado no boleto do condomínio de 11/2025.",
            ],
            [
                'name' => 'Modelo para envio do rateio mensal',
                'slug' => 'rateio-mensal',
                'content' => "📋 Prezados(as), bom dia.\n
Segue o rateio do condomínio referente a 11/2025.\n
Os boletos digitais, com vencimento em 14/11/2025, serão enviados individualmente.",
            ],
            [
                'name' => 'Modelo para envio de boleto',
                'slug' => 'envio-boleto',
                'content' => "🗒️ Olá, boa tarde.\n
Segue o boleto do condomínio com vencimento em 14/11/2025.\n
Favor confirmar o recebimento.",
            ],
            [
                'name' => 'Modelo para lembrete de vencimento (dia anterior)',
                'slug' => 'lembrete-vencimento',
                'content' => "⏰ Prezados(as), bom dia.\n
Lembramos que o vencimento do condomínio é amanhã, dia 14/11/2025."
            ],
            [
                'name' => 'Modelo para lembrete de vencimento (no dia)',
                'slug' => 'vencimento-hoje',
                'content' => "🚨 Importante!\n
Lembramos que o vencimento do condomínio é hoje, dia 14/11/2025."
            ],
            [
                'name' => 'Modelo para confirmação de recebimento/pagamento',
                'slug' => 'confirmacao-pagamento',
                'content' => "✅  Prezados(as), bom dia.\n
Todos os boletos referentes ao condomínio de 11/2025 foram confirmados.\n
Segue anexo para conferência: Período: 15/10/2025 a 16/11/2025\n
Atenciosamente,\n

Filipe Augusto Magalhães\n
Síndico - Ed. Angela",
            ],
        ]);
    }
}
