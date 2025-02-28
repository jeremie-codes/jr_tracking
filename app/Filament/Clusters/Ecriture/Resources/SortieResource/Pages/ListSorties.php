<?php

namespace App\Filament\Clusters\Ecriture\Resources\SortieResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\SortieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSorties extends ListRecords
{
    protected static string $resource = SortieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
