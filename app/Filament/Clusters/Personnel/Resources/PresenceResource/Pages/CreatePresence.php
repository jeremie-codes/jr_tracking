<?php

namespace App\Filament\Clusters\Personnel\Resources\PresenceResource\Pages;

use App\Filament\Clusters\Personnel\Resources\PresenceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePresence extends CreateRecord
{
    protected static string $resource = PresenceResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return $this->getResource()::getUrl('index');
    }
}
