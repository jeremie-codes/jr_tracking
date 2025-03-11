<?php

namespace App\Observers;

use App\Models\Commande;
use App\Models\Devise;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
class CommandeObserver
{
    public function created(Commande $commande): void
    {

        // dd($commande->user);
        $recipient = $commande->user;
        $devise = Devise::where('id', $commande->devise_id)->first();
        Notification::make()
            ->title('Approvisionnement initié par : ' . Auth::user()->name)
            ->body('Montant: ' . $commande->montant . ' ' . $devise->code)
            ->icon('heroicon-o-shopping-bag')
            ->actions([
                Action::make('Approuver')
                    ->button()
                    ->color('warning'),
                Action::make('Désapprouver')
                    ->color('danger'),
            ])
            ->sendToDatabase($recipient,  isEventDispatched: true);

        // Notification::make()
        //     ->title('Confirmer l\'Approvisionnement de : ' . Auth::user()->name)
        //     ->body('Montant:' . $commande->montant)
        //     ->icon('heroicon-o-shopping-bag')
        //     ->actions([
        //         Action::make('Approuver')
        //             ->button()
        //             ->color('warning'),
        //         Action::make('Désapprouver')
        //             ->color('danger'),
        //     ])
        //     ->sendToDatabase($recipient,  isEventDispatched: true);
    }
}
