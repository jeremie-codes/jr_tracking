<?php

namespace App\Observers;

use App\Models\Commande;
use Filament\Notifications\Notification;

class CommandeObserver
{
    public function created(Commande $commande): void
    {
        Notification::make()
            ->title('Vous avez une nouvelle: ' . $commande->name)
            ->sendToDatabase(auth()->user->id);
    }
}
