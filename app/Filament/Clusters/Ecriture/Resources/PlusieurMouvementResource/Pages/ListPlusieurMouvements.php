<?php

namespace App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPlusieurMouvements extends ListRecords
{
    protected static string $resource = PlusieurMouvementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
