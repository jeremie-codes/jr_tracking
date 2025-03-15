<?php

namespace App\Filament\Clusters\Personnel\Resources\AgentResource\Pages;

use App\Filament\Clusters\Personnel\Resources\AgentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgent extends EditRecord
{
    protected static string $resource = AgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
