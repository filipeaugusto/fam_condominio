<?php

namespace App\Filament\Resources\MonthlyClosingApartments\Actions;

use App\Models\MonthlyClosingApartment;
use App\Services\Inter\CondominiumBilletService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Support\Icons\Heroicon;

class GenerateBilletAction extends Action
{

    public static function make(?string $name = 'generate-billet'): static
    {
        return parent::make($name)
            ->label('Gerar Boleto')
            ->icon( Heroicon::OutlinedDocumentPlus)
            ->color(Color::Cyan)
            ->button()
            ->requiresConfirmation()
            ->action(function (MonthlyClosingApartment $record) {

                try {
                    app(CondominiumBilletService::class)->generateForApartment($record);
                    Notification::make()
                        ->title('Boleto gerado com sucesso!')
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Notification::make()
                        ->title('Erro ao gerar boleto!')
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            })
            ->visible(fn ($record) => !$record->is_billet_generated && $record->monthly_closing_id);
    }
}
