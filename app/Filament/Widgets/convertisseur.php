<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Devise;
use App\Models\Taux;
use Illuminate\Http\Request;

class convertisseur extends Widget
{
    protected static ?int $sort = 1;

    protected static string $view = 'filament.widgets.convertisseur';

    public $devises;
    public $deviseSource;
    public $deviseCible;
    public $montant;
    public $resultat;

    public function mount()
    {
        $this->devises = Devise::all();
        $this->deviseSource = 'USD';
        $this->deviseCible = 'CDF';
        $this->montant = 0;
        $this->resultat = 0;
    }

    public function convertir(Request $request)
    {

        $data = json_decode($request->components[0]['snapshot'])->data;
        $updates = $request->components[0]['updates'];

        $this->deviseSource = $data->deviseSource;
        // $this->montant = 0;

        if(count($updates) > 0) {
            $deviSource = $updates['deviseSource'] ?? null;
            $deviseCible = $updates['deviseCible'] ?? null;
            $devimontant = $updates['montant'] ?? null;

            if($deviSource){
                $this->deviseSource = $updates['deviseSource'];
            }
            if($deviseCible){
                $this->deviseCible = $updates['deviseCible'];
            }
            if($devimontant){
                $this->montant = $updates['montant'];
            }
        }

        $deviseSource = Devise::where('code', $this->deviseSource)->get()->first();
        $devisecible = Devise::where('code', $this->deviseCible)->get()->first();
        $taux = Taux::where('devise_source_id', $deviseSource->id)
                    ->where('devise_cible_id', $devisecible->id)->get();

        // dd($taux[0]);
        if ($taux) {
            $this->resultat = $this->montant * ($taux ? $taux[0]->taux_vente : 1);
        } else {
            $this->resultat = 'Taux non trouvé';
        }

        return redirect()->back()->withInput()->with('resultat', $this->resultat);
    }
}
