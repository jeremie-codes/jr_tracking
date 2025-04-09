<?php

namespace App\Filament\Resources\CommandeAgentResource\Pages;

use App\Filament\Resources\CommandeAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommandeAgent extends EditRecord
{
    protected static string $resource = CommandeAgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
