<?php

namespace App\Filament\Traits;

trait RedirectsAfterSave
{
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
