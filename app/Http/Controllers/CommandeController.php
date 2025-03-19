<?php

namespace App\Http\Controllers;

use App\Filament\Resources\CommandeResource;
use App\Models\Commande;
use App\Models\Notification;
use App\Models\PlusieurMouvement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;


class CommandeController extends Controller
{
    public function approuver(Request $request)
    {

        $notificationFind = Notification::where('data', 'like', $request->notification)->get();
        // Supprimer chaque notification trouvée
        foreach ($notificationFind as $notification) {
            $notification->delete();
        }

        // Récupérer la commande à partir de l'ID
        $commande = Commande::find($request->commande);


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
                    'note' => $commande->note,
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
                    'note' => $commande->note,
                    // Ajoutez d'autres champs nécessaires
                ]);
            }
            else
            {
                PlusieurMouvement::create([
                    'auteur' => $commande->person->name,
                    'nature' => 'entree',
                    'type' => 'Approvisionnement',
                    'user_id' => $commande->user_id,
                    'montant' => $commande->montant,
                    'devise_id' => $commande->devise_id,
                    'article_id' => $commande->article_id,
                    'note' => $commande->note,
                    // Ajoutez d'autres champs nécessaires
                ]);

                PlusieurMouvement::create([
                    'auteur' => $commande->user->name,
                    'nature' => 'sortie',
                    'type' => 'Cession de fond',
                    'user_id' => $commande->person_id,
                    'montant' => $commande->montant,
                    'devise_id' => $commande->devise_id,
                    'article_id' => $commande->article_id,
                    'note' => $commande->note,
                    // Ajoutez d'autres champs nécessaires
                ]);
            }
        }

        $notificationFind = Notification::where('data', 'like', $request->notification)->get();
        // Supprimer chaque notification trouvée
        foreach ($notificationFind as $notification) {
            $notification->delete();
        }

        return redirect()->back()->with('success', 'Commande approuvée et enregistrée dans le rapport.');
    }
    public function desapprouver(Request $request)
    {

        $notificationFind = Notification::where('data', 'like', $request->notification)->get();
        // Supprimer chaque notification trouvée
        foreach ($notificationFind as $notification) {
            $notification->delete();
        }

        // Récupérer la commande à partir de l'ID
        $commande = Commande::find($request->commande);

        if ($commande->status === 'attente')
        {
            $commande->update([
                'status' => 'désapprouvée',
            ]);
        }

        $notificationFind = Notification::where('data', 'like', $request->notification)->get();
        // Supprimer chaque notification trouvée
        foreach ($notificationFind as $notification) {
            $notification->delete();
        }


        return redirect()->back()->with('success', 'Commande désapprouvée avec succès.');
    }
    public function modifier(Request $request)
    {

        $notificationFind = Notification::where('data', 'like', $request->notification)->get();

        // Supprimer chaque notification trouvée
        foreach ($notificationFind as $notification) {
            $notification->delete();
        }

        return redirect(CommandeResource::getUrl('edit', ['record' => $request->commande]));
    }
}
