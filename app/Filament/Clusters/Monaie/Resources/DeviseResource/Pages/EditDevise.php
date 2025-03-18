<?php

namespace App\Filament\Clusters\Monaie\Resources\DeviseResource\Pages;

use App\Filament\Clusters\Monaie\Resources\DeviseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDevise extends EditRecord
{
    protected static string $resource = DeviseResource::class;

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
