<?php

namespace App\Filament\Resources\ApprovisionnerAgentResource\Pages;

use App\Filament\Resources\ApprovisionnerAgentResource;
use App\Filament\Resources\CommandeResource\Widgets\StateOrder;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListApprovisionnerAgents extends ListRecords
{
    protected static string $resource = ApprovisionnerAgentResource::class;
    use ExposesTableToWidgets;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Approvisionner')
            ->icon('heroicon-o-plus'),
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
