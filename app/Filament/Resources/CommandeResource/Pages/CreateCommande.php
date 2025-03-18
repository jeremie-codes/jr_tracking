<?php

namespace App\Filament\Resources\CommandeResource\Pages;

use App\Filament\Resources\CommandeResource;
use Filament\Resources\Pages\CreateRecord;
use App\Notifications\CommandeNotification;

class CreateCommande extends CreateRecord
{
    protected static string $resource = CommandeResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return $this->getResource()::getUrl('index');
    }
}
