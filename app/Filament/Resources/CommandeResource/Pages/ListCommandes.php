<?php

namespace App\Filament\Resources\CommandeResource\Pages;

use App\Filament\Resources\CommandeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\CommandeResource\Widgets\StateOrder;
use App\Filament\Resources\CommandeResource\Widgets\CommandeNotification;
use App\Models\Commande;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ListCommandes extends ListRecords
{
    protected static string $resource = CommandeResource::class;
    use ExposesTableToWidgets;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Passer une commande')
                ->icon('heroicon-o-plus'),
        ];
    }

    protected function getHeaderWidgets(): array
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

        if (Auth::user()->role === 'Operateur-e-money' || Auth::user()->role === 'Admin') {
            return [
                null => Tab::make('Tout'),
                Tab::make('Approuvée')
                    ->label('Approuvée')
                    ->query(fn ($query) => $query->where('status', 'approuvée')),

                Tab::make('Attente')
                    ->label('Attente')
                    ->query(fn ($query) => $query->where('status', 'attente')),

                Tab::make('Annulée')
                    ->label('Annulée')
                    ->query(fn ($query) => $query->where('status', 'annulée')),

                Tab::make('Dépôt')
                    ->label('Dépôt')
                    ->query(fn ($query) => $query->where('type', 'depot')),

                Tab::make('Retrait')
                    ->label('Retrait')
                    ->query(fn ($query) => $query->where('type', 'retrait')),
            ];
        }

        return [
            null => Tab::make('Tout'),
            Tab::make('Approuvée')
                ->label('Approuvée')
                ->query(fn ($query) => $query->where('status', 'approuvée')),

            Tab::make('Attente')
                ->label('Attente')
                ->query(fn ($query) => $query->where('status', 'attente')),

            Tab::make('Annulée')
                ->label('Annulée')
                ->query(fn ($query) => $query->where('status', 'annulée')),
        ];
    }
}
