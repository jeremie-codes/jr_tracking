<?php

namespace App\Filament\Clusters\Monaie\Resources\TauxResource\Pages;

use App\Filament\Clusters\Monaie\Resources\TauxResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTaux extends CreateRecord
{
    protected static string $resource = TauxResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return $this->getResource()::getUrl('index');
    }
}
