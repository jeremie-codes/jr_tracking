<?php

namespace App\Filament\Clusters\Monaie\Resources\TauxResource\Pages;

use App\Filament\Clusters\Monaie\Resources\TauxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTauxes extends ListRecords
{
    protected static string $resource = TauxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
