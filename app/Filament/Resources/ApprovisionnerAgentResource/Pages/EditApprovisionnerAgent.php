<?php

namespace App\Filament\Resources\ApprovisionnerAgentResource\Pages;

use App\Filament\Resources\ApprovisionnerAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApprovisionnerAgent extends EditRecord
{
    protected static string $resource = ApprovisionnerAgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Supprimer'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return $this->getResource()::getUrl('index');
    }

}
