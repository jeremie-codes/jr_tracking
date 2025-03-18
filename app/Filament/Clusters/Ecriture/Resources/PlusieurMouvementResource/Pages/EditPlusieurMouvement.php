<?php

namespace App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\EntréeResource;
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

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return EntréeResource::getUrl('index');
    }
}
