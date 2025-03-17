<?php

namespace App\Filament\Resources\IndicateurResource\Pages;

use App\Filament\Resources\IndicateurResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListIndicateurs extends ListRecords
{
    protected static string $resource = IndicateurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Tout'),

            Tab::make('dette')
                ->label('dettes')
                ->query(fn ($query) => $query->where('type', 'dette')),

            Tab::make('paiement')
                ->label('paiements')
                ->query(fn ($query) => $query->where('type', 'paiement')),

            Tab::make('manquant')
                ->label('manquants')
                ->query(fn ($query) => $query->where('type', 'manquant')),

            Tab::make('excédent')
                ->label('excédents')
                ->query(fn ($query) => $query->where('type', 'excédent')),
        ];
    }
}
