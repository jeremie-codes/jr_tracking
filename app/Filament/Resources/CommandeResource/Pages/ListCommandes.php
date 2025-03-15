<?php

namespace App\Filament\Resources\CommandeResource\Pages;

use App\Filament\Resources\CommandeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\CommandeResource\Widgets\StateOrder;


class ListCommandes extends ListRecords
{
    protected static string $resource = CommandeResource::class;
    use ExposesTableToWidgets;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Passer une commande'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StateOrder::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Tout'),
            Tab::make('Approuvée')
                ->label('Approuvée')
                ->query(fn ($query) => $query->where('status', 'approuvée')),

            Tab::make('Attente')
                ->label('Attente')
                ->query(fn ($query) => $query->where('status', 'attente')),

            Tab::make('Désapprouvée')
                ->label('Désapprouvée')
                ->query(fn ($query) => $query->where('status', 'désapprouvée')),
        ];
    }
}
