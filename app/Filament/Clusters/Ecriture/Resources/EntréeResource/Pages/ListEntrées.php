<?php

namespace App\Filament\Clusters\Ecriture\Resources\EntréeResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\EntréeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EcritureExport;

class ListEntrées extends ListRecords
{
    protected static string $resource = EntréeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('Exporter')
                ->color('danger')
                ->icon('heroicon-o-document-arrow-up')
                ->action(fn () => Excel::download(new EcritureExport, 'export.xlsx')),
            Actions\CreateAction::make()->label('Nouvelle écriture')
                ->icon('heroicon-o-plus'),

        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('Tout'),
            Tab::make('Consign°')
                ->query(fn ($query) => $query->where('type', 'Consignation')),
            Tab::make('Approv°')
                ->query(fn ($query) => $query->where('type', 'Approvisionnement')),
            Tab::make('Paie dette')
                ->query(fn ($query) => $query->where('type', 'Paiement dette')),
            Tab::make('Manq. retrouvé')
                ->query(fn ($query) => $query->where('type', 'Manquant retrouvé')),
            Tab::make('Paie commission')
                ->query(fn ($query) => $query->where('type', 'Paiement commission')),
            Tab::make('Autres')
                ->query(fn ($query) => $query->where('type', 'Autres')),
        ];
    }
}
