<?php

namespace App\Filament\Resources\ApprovisionnerAgentResource\Pages;

use App\Filament\Resources\ApprovisionnerAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateApprovisionnerAgent extends CreateRecord
{
    protected static string $resource = ApprovisionnerAgentResource::class;

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return $this->getResource()::getUrl('index');
    }

}
