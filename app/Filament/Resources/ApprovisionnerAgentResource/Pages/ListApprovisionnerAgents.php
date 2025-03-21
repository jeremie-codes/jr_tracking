<?php

namespace App\Filament\Resources\ApprovisionnerAgentResource\Pages;

use App\Filament\Resources\ApprovisionnerAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApprovisionnerAgents extends ListRecords
{
    protected static string $resource = ApprovisionnerAgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
