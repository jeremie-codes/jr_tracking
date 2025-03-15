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
        $recipient = $commande->user;
        $devise = Devise::where('id', $commande->devise_id)->first();

        if ($commande->status !== 'désapprouvée' && $commande->status !== 'approuvée') {
            Notification::make()
                ->title($commande->type === 'cession de fond' ? 'Cession de fond initié par : ' . Auth::user()->name : 'Demande Approvisionnement par : ' . Auth::user()->name)
                ->body('Montant: ' . $commande->montant . ' ' . $devise->code . ' pour ' . $commande->article->name)
                ->icon('heroicon-o-shopping-bag')
                ->actions([
                Action::make('Approuver')
                    ->close()
                    ->button()
                    ->markAsRead()
                    ->color('success')
                    ->url(route('commandes.approuver', ['commande' => $commande->id, 'notification' => "%Ref-$commande->id%"])),
                Action::make('Modifier')
                    ->close()
                    ->button()
                    ->markAsRead()
                    ->color('warning')
                    ->url(route('commandes.modifier', ['commande' => $commande->id, 'notification' => "%Ref-$commande->id%"])),
                Action::make('Désapprouver')
                    ->close()
                    ->markAsRead()
                    ->url(route('commandes.desapprouver', ['commande' => $commande->id, 'notification' => "%Ref-$commande->id%"]))
                    ->color('danger'),
            ])->sendToDatabase($recipient);
        }

    }

    public function updated(Commande $commande): void
    {
        $recipient = $commande->person;
        $devise = Devise::where('id', $commande->devise_id)->first();

        if ($commande->status !== 'désapprouvée' && $commande->status !== 'approuvée') {
            Notification::make()
                ->title($commande->type === 'cession de fond' ? 'Cession de fond modifié par : ' . Auth::user()->name : 'Demande Approvisionnement Modifié par : ' . Auth::user()->name)
                ->body('Ref-' . $commande->id .' Montant: ' . $commande->montant . ' ' . $devise->code . ' pour ' . $commande->article->name)
                ->icon('heroicon-o-shopping-bag')
                ->actions([
                    Action::make('Approuver')
                    ->close()
                        ->button()
                        ->color('success')
                        ->url(route('commandes.approuver', ['commande' => $commande->id, 'notification' => "%Ref-$commande->id%"])),
                    Action::make('Désapprouver')
                    ->close()
                        ->color('danger')
                        ->url(route('commandes.desapprouver', ['commande' => $commande->id, 'notification' => "%Ref-$commande->id%"]))
                ])->sendToDatabase($recipient);

        }

        if ($commande->status === 'approuvée') {
            Notification::make()
                ->title("Votre Commande de ". $commande->montant . " " . $devise->code . " est approuvée !")
                ->body('Montant: ' . $commande->montant . ' ' . $devise->code . ' pour ' . $commande->article->name)
                ->success()
                ->sendToDatabase($recipient);

        }

        if ($commande->status === 'désapprouvée') {
            Notification::make()
                ->title("Votre commande de ". $commande->montant . " " . $devise->code . " est désapprouvée !")
                ->body('Montant: ' . $commande->montant . ' ' . $devise->code . ' pour ' . $commande->article->name)
                ->danger()
                ->sendToDatabase($recipient);

        }
    }
}
