<?php

namespace App\Filament\Resources\IndicateurResource\Pages;

use App\Filament\Resources\IndicateurResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIndicateurs extends ListRecords
{
    protected static string $resource = IndicateurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
