<?php

namespace App\Filament\Resources\CommunicationTemplates\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CommunicationTemplateInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Título'),
                TextEntry::make('slug'),
                TextEntry::make('content')
                    ->label('Conteúdo')
                    ->html() // renderiza HTML vindo do RichEditor
                    ->extraAttributes(['class' => 'prose max-w-none'])
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
