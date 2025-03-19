<?php

namespace App\Filament\Clusters\Ecriture\Resources\SortieResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\SortieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListSorties extends ListRecords
{
    protected static string $resource = SortieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Nouvelle écriture')
                ->icon('heroicon-o-plus'),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Tout'),
            Tab::make('C° de fond')
                ->query(fn ($query) => $query->where('type', 'Cession de fond')),
            Tab::make('Dette')
                ->query(fn ($query) => $query->where('type', 'Dette')),
            Tab::make('Remboursement')
                ->query(fn ($query) => $query->where('type', 'Remboursement')),
            Tab::make('Exc. retrouvé')
                ->query(fn ($query) => $query->where('type', 'Excédent retrouvé')),
            Tab::make('Dépenses')
                ->query(fn ($query) => $query->where('type', 'Dépenses')),
            Tab::make('Autres')
                ->query(fn ($query) => $query->where('type', 'Autres')),
        ];
    }
}
