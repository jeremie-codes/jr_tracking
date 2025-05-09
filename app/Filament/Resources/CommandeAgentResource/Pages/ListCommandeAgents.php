<?php

namespace App\Filament\Resources\CommandeAgentResource\Pages;

use App\Filament\Resources\CommandeAgentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\CommandeAgentResource\Widgets\StateOrder;
use App\Filament\Resources\CommandeAgentResource\Widgets\CommandeNotification;
use App\Models\Commande;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ListCommandeAgents extends ListRecords
{
    protected static string $resource = CommandeAgentResource::class;
    use ExposesTableToWidgets;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Nouvelle commande')
                ->icon('heroicon-o-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        $commandeCount = Commande::where('user_id', Auth::id())
            ->where('see_id', Auth::id())->where('type','depot')
            ->where('status', 'attente')->orderBy('created_at', 'desc')->get()->count();

        if ($commandeCount > 0) {

            Notification::make()
            ->title('Vous avez des notifications en attente')
            ->body('Consultez pour approuver ou annuler.')
            ->warning()
            ->color('warning')
            ->persistent()
            ->send();

            return [
                CommandeNotification::make(),
            ];
        }

        return [
            StateOrder::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            Tab::make('Tout')
                ->label('Tout')
                ->query(fn ($query) => $query), // Pas de filtre, affiche tout

            Tab::make('Approuvée')
                ->label('Approuvée')
                ->query(fn ($query) => $query->where('status', 'approuvée')),

            Tab::make('Attente')
                ->label('Attente')
                ->query(fn ($query) => $query->where('status', 'attente')),

            Tab::make('Annulée')
                ->label('Annulée')
                ->query(fn ($query) => $query->where('status', 'annulée')),

            // Tab::make('Dépôt')
            //     ->label('Dépôt')
            //     ->query(fn ($query) => $query->where('type', 'depot')),

            // Tab::make('Retrait')
            //     ->label('Retrait')
            //     ->query(fn ($query) => $query->where('type', 'retrait')),
        ];
    }
}
