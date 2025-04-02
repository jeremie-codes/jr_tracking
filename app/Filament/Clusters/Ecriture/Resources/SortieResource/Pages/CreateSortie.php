<?php

namespace App\Filament\Clusters\Ecriture\Resources\SortieResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\SortieResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Pages\AllEcriture;

class CreateSortie extends CreateRecord
{
    protected static string $resource = SortieResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return AllEcriture::getUrl();
    }
}
