<?php

namespace App\Filament\Clusters\Ecriture\Resources\EntréeResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\EntréeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use App\Models\Commande;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ListEntrées extends ListRecords
{
    protected static string $resource = EntréeResource::class;

    protected function getHeaderActions(): array
    {
        $commandeCount = Commande::where('user_id', Auth::id())
            ->where('see_id', Auth::id())->where('status', 'attente')
            ->orderBy('created_at', 'desc')->get()->count();

        if ($commandeCount > 0) {

            Notification::make()
            ->title('Vous avez des notifications en attente')
            ->body('Consultez pour approuver ou annuler.')
            ->warning()
            ->color('warning')
            ->persistent()
            ->send();
        }

        return [
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
