<?php

namespace App\Filament\Clusters\Ecriture\Resources\SortieResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\SortieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Pages\AllEcriture;

class EditSortie extends EditRecord
{
    protected static string $resource = SortieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Supprimer'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return AllEcriture::getUrl();
    }
}
