<?php

namespace App\Filament\Resources\CommandeResource\Pages;

use App\Filament\Resources\CommandeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommande extends EditRecord
{
    protected static string $resource = CommandeResource::class;

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
