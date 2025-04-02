<?php

namespace App\Observers;

use App\Filament\Resources\CommandeResource;
use App\Models\Commande;
use App\Models\Devise;
use App\Models\Notification as ModelsNotification;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CommandeObserver
{
    public function created(Commande $commande): void
    {
        // 
    }

    public function updated(Commande $commande): void
    {
        // 
    }
}
