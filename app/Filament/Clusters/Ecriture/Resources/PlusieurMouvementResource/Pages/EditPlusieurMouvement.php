<?php

namespace App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlusieurMouvement extends EditRecord
{
    protected static string $resource = PlusieurMouvementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
