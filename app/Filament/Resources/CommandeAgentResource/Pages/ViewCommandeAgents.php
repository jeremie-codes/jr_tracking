<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\CommandeAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMessage extends ViewRecord
{
    protected static string $resource = CommandeAgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()->label('Modifier'),
            Actions\DeleteAction::make()->label('Supprimer'),
        ];
    }
}
