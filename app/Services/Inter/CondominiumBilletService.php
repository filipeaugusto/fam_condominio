<?php

namespace App\Services\Inter;

use App\Models\MonthlyClosingApartment;
use Exception;

class CondominiumBilletService
{
    /**
     * @throws Exception
     */
    public function generateForApartment(MonthlyClosingApartment $record)
    {
        $inter = app(InterApiService::class);

        $payload = [
            "pagador" => [
                "cpfCnpj" => $record->apartment->latestResident?->user?->document ?? '00000000000',
                "nome" => $record->apartment->latestResident?->user?->name ?? 'Morador',
            ],
            "dataVencimento" => now()->format("Y-m-15"),
            "seuNumero" => 'MC-' . str_pad($record->id, 5, '0', STR_PAD_LEFT),
            "valorNominal" => (float) $record->amount_final,
        ];

        $response = $inter->generateBillet($payload);

        // salva no banco
        $record->update([
            'is_billet_generated' => true,
            'billet_generated_at' => now(),
            'billet_number' => $response['nossoNumero'] ?? null,
            'billet_url' => $response['pdf']['original'] ?? null,
        ]);

        return $response;
    }
}
