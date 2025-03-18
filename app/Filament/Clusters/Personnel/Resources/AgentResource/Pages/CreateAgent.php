<?php

namespace App\Filament\Clusters\Personnel\Resources\AgentResource\Pages;

use App\Filament\Clusters\Personnel\Resources\AgentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAgent extends CreateRecord
{
    protected static string $resource = AgentResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return $this->getResource()::getUrl('index');
    }
}
