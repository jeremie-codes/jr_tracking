<?php

namespace App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource;
use App\Filament\Clusters\Ecriture\Resources\EntréeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
 
class CreatePlusieurMouvement extends CreateRecord
{
    protected static string $resource = PlusieurMouvementResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return EntréeResource::getUrl('index');
    }
}
