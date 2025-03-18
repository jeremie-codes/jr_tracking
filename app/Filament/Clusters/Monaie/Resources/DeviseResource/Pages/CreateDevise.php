<?php

namespace App\Filament\Clusters\Monaie\Resources\DeviseResource\Pages;

use App\Filament\Clusters\Monaie\Resources\DeviseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDevise extends CreateRecord
{
    protected static string $resource = DeviseResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return $this->getResource()::getUrl('index');
    }
}
