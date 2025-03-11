<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\PlusieurMouvement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Commande $commande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commande $commande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commande $commande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commande $commande)
    {
        //
    }

    public function approuver(Request $request, Commande $commande)
    {
        // Supprimer la notification
        $notification = $request->user()->notifications()->find($request->notification_id);
        if ($notification) {
            $notification->delete();
        }

        // Enregistrer les informations de la commande dans la table ecriture
        PlusieurMouvement::create([
            'commande_id' => $commande->id,
            'user_id' => Auth::id(),
            'montant' => $commande->montant,
            'devise_id' => $commande->devise_id,
            'article_id' => $commande->article_id,
            'note' => $commande->note,
            // Ajoutez d'autres champs nécessaires
        ]);

        return redirect()->back()->with('success', 'Commande approuvée et enregistrée dans le rapport.');
    }
}
