<?php

namespace App\Filament\Clusters\Ecriture\Resources\SortieResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\SortieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSortie extends EditRecord
{
    protected static string $resource = SortieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return $this->getResource()::getUrl('index');
    }
}
