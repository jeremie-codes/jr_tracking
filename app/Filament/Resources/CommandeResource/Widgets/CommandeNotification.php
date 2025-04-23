<?php

namespace App\Filament\Resources\CommandeResource\Widgets;

use Filament\Widgets\Widget;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use App\Models\PlusieurMouvement;
use App\Filament\Resources\CommandeResource;
use Filament\Notifications\Notification;

class CommandeNotification extends Widget
{
    protected static string $view = 'filament.resources.commande-resource.widgets.commande-notification';
    protected static ?string $pollingInterval = '2000';
    protected int | string | array $columnSpan = 'full';
    public function getCommandes()
    {
        // Récupérer les notifications pour l'utilisateur connecté
        return Commande::where('see_id', Auth::id())
            ->where('status', 'attente')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function approveCommande($id)
    {
        $commande = Commande::find($id);
        if ($commande) {

            // Enregistrer les informations de la commande dans la table ecriture
            if ($commande->status !== 'approuvée')
            {
                $commande->update([
                    'status' => 'approuvée',
                ]);

                if ($commande->type == 'demande approvisionnement')
                {
                    PlusieurMouvement::create([
                        'auteur' => $commande->user->name,
                        'nature' => 'entree',
                        'type' => 'Approvisionnement',
                        'user_id' => $commande->person_id,
                        'montant' => $commande->montant,
                        'devise_id' => $commande->devise_id,
                        'article_id' => $commande->article_id,
                        'note' => $commande->note . ' ' . $commande->libele,
                        // Ajoutez d'autres champs nécessaires
                    ]);

                    PlusieurMouvement::create([
                        'auteur' => $commande->person->name,
                        'nature' => 'sortie',
                        'type' => 'Cession de fond',
                        'user_id' => $commande->user_id,
                        'montant' => $commande->montant,
                        'devise_id' => $commande->devise_id,
                        'article_id' => $commande->article_id,
                        'note' => $commande->note . ' ' . $commande->libele,
                        'by_command' => true,
                    ]);
                }
                else
                {
                    if ($commande->type !== 'depot' || $commande->type !== 'retrait'){
                        PlusieurMouvement::create([
                            'auteur' => $commande->person->name,
                            'nature' => 'entree',
                            'type' => 'Approvisionnement',
                            'user_id' => $commande->user_id,
                            'montant' => $commande->montant,
                            'devise_id' => $commande->devise_id,
                            'article_id' => $commande->article_id,
                            'note' => $commande->note . ' ' . $commande->libele,
                        ]);

                        PlusieurMouvement::create([
                            'auteur' => $commande->user->name,
                            'nature' => 'sortie',
                            'type' => 'Cession de fond',
                            'user_id' => $commande->person_id,
                            'montant' => $commande->montant,
                            'devise_id' => $commande->devise_id,
                            'article_id' => $commande->article_id,
                            'note' => $commande->note . ' ' . $commande->libele,
                            'by_command' => true,
                        ]);
                    }
                }

                Notification::make()
                    ->title('Commande approuvée avec succès !')
                    ->color('success')
                    ->duration(5000)
                    ->success()
                    ->send();
            }

        }
    }

    public function modifyCommande($id)
    {
        // $notification = Commande::find($id);
        return redirect(CommandeResource::getUrl('edit', ['record' => $id]));
    }

    public function cancelCommande($id)
    {
        $commande = Commande::find($id);

        if ($commande->status === 'attente')
        {
            $commande->update([
                'status' => 'annulée',
            ]);

            Notification::make()
                ->title('Commande annulée avec succès !')
                ->color('success')
                ->duration(5000)
                ->success()
                ->send();
        }
    }
}
