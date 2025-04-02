<?php

namespace App\Filament\Resources\VerifierRetraitResource\Pages;

use App\Filament\Resources\VerifierRetraitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\VerifierRetraitResource\Widgets\StateOrder;
use App\Filament\Resources\VerifierRetraitResource\Widgets\CommandeNotification;
use App\Models\Commande;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Notifications\Notification;

class ListVerifierRetraits extends ListRecords
{
    protected static string $resource = VerifierRetraitResource::class;
    use ExposesTableToWidgets;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Vérifier un retrait')->icon('heroicon-o-magnifying-glass'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        $commandeCount = Commande::where('user_id', Auth::id())
            ->where('see_id', Auth::id())->where('type','retrait')
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
