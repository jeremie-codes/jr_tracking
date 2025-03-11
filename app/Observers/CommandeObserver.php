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

        $recipient = $commande->user;
        $devise = Devise::where('id', $commande->devise_id)->first();
        Notification::make()
            ->title($commande->type === 'cession de fond' ? 'Cession de fond initié par : ' . Auth::user()->name : 'Demande Approvisionnement par : ' . Auth::user()->name)
            ->body('Montant: ' . $commande->montant . ' ' . $devise->code . ' pour ' . $commande->article->name)
            ->icon('heroicon-o-shopping-bag')
            ->actions([
                Action::make('Approuver')
                    ->button()
                    ->close()
                    ->color('success')
                    ->url(route('commandes.approuver', ['commande' => $commande->id])),
                Action::make('Modifier')
                    ->button()
                    ->close()
                    ->color('warning'),
                Action::make('Désapprouver')
                    ->close()
                    ->color('danger'),
            ])
            ->sendToDatabase($recipient,  isEventDispatched: true);
    }
}
