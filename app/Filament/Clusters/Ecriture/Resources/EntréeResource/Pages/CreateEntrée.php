<?php

namespace App\Filament\Clusters\Ecriture\Resources\EntréeResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\EntréeResource;
use App\Filament\Pages\AllEcriture;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEntrée extends CreateRecord
{
    protected static string $resource = EntréeResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return AllEcriture::getUrl();
    }
}
