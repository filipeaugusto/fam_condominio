<?php

namespace App\Filament\Resources\CommunicationTemplates\Pages;

use App\Filament\Resources\CommunicationTemplates\CommunicationTemplateResource;
use App\Filament\Traits\RedirectsAfterSave;
use Filament\Resources\Pages\CreateRecord;

class CreateCommunicationTemplate extends CreateRecord
{
    use RedirectsAfterSave;

    protected static string $resource = CommunicationTemplateResource::class;
}
