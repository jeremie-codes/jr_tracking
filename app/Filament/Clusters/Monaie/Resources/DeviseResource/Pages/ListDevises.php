<?php

namespace App\Filament\Clusters\Monaie\Resources\DeviseResource\Pages;

use App\Filament\Clusters\Monaie\Resources\DeviseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDevises extends ListRecords
{
    protected static string $resource = DeviseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
