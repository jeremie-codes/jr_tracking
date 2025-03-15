<?php

namespace App\Listeners;

use App\Events\CommandeDesapprouvee;
use App\Models\Devise;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SendCommandeDesapprouveeNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    // public function handle(CommandeDesapprouvee $event)
    // {
    //     $commande = $event->commande;

    //     $commande->update([
    //         'status' => 'désapprovée'
    //     ]);

    //     $recipient = $commande->user;
    //     $recipient2 = $commande->person;

    //     $devise = Devise::where('id', $commande->devise_id)->first();

    //     Notification::make()
    //         ->title('Commande Désapprouvée par : ' . Auth::user()->name)
    //         ->body('Montant: ' . $commande->montant . ' ' . $devise->code . ' pour ' . $commande->article->name)
    //         ->icon('heroicon-o-x-circle')
    //         ->sendToDatabase($recipient, isEventDispatched: true);

    //     Notification::make()
    //         ->title('Commande Désapprouvée par : ' . Auth::user()->name)
    //         ->body('Montant: ' . $commande->montant . ' ' . $devise->code . ' pour ' . $commande->article->name)
    //         ->icon('heroicon-o-x-circle')
    //         ->sendToDatabase($recipient2    , isEventDispatched: true);

    // }
}
