<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Tables;
use App\Models\Devise;
use Filament\Pages\Page;
use App\Models\PlusieurMouvement;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EcritureExport;
use App\Models\Indicateur;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class RapportParAgent extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = "Rapports";
    protected static ?int $navigationSort = 3;
    protected static string $view = 'filament.pages.rapport-par-agent';

    public $devises = array();

    public function __construct() {
        $this->devises['cdf'] = Devise::where('code', 'CDF')->get()->first()->code ?? null;
        $this->devises['usd'] = Devise::where('code', 'USD')->get()->first()->code ?? null;
        $this->devises['eur'] = Devise::where('code', 'EUR')->get()->first()->code ?? null;
        $this->devises['cfa'] = Devise::where('code', 'CFA')->get()->first()->code ?? null;

         // Filtrage des éléments avec valeur non nulle
        $this->devises = array_filter($this->devises, function($value) {
            return !is_null($value); // Ne garde que les éléments non nuls
        });
    }

    public function getUsersWithEcritures()
    {
        return User::whereIn('id', PlusieurMouvement::pluck('user_id'))->get();
    }

    public function getEcrituresForTable($userId, $selectedDate = null)
    {
        $date = $selectedDate ? $selectedDate : now()->toDateString(); // Utilise la date sélectionnée ou celle d'aujourd'hui
        // dd($date);
        $query = PlusieurMouvement::where('user_id', $userId)
            ->whereDate('created_at', $date)
            ->with('devise')
            ->get();

        $tableData = [];

        foreach ($query as $item) {
            // Vérifiez si une ligne avec le même id_ref existe déjà
            $existingRowKey = array_search($item->id_ref, array_column($tableData, 'id'));

            if ($existingRowKey !== false) {
                // Si une ligne avec le même id_ref existe, mettez à jour les colonnes correspondantes
                $tableData[$existingRowKey]['entree_cdf'] += $item->nature === 'entree' && $item->devise->code === 'CDF' ? $item->montant : 0;
                $tableData[$existingRowKey]['entree_usd'] += $item->nature === 'entree' && $item->devise->code === 'USD' ? $item->montant : 0;
                $tableData[$existingRowKey]['entree_eur'] += $item->nature === 'entree' && $item->devise->code === 'EUR' ? $item->montant : 0;
                $tableData[$existingRowKey]['entree_cfa'] += $item->nature === 'entree' && $item->devise->code === 'CFA' ? $item->montant : 0;
                $tableData[$existingRowKey]['sortie_cdf'] += $item->nature === 'sortie' && $item->devise->code === 'CDF' ? $item->montant : 0;
                $tableData[$existingRowKey]['sortie_usd'] += $item->nature === 'sortie' && $item->devise->code === 'USD' ? $item->montant : 0;
                $tableData[$existingRowKey]['sortie_eur'] += $item->nature === 'sortie' && $item->devise->code === 'EUR' ? $item->montant : 0;
                $tableData[$existingRowKey]['sortie_cfa'] += $item->nature === 'sortie' && $item->devise->code === 'CFA' ? $item->montant : 0;
            } else {
                // Sinon, ajoutez une nouvelle ligne
                $tableData[] = [
                    'id' => $item->id,
                    'ref' => $item->id_ref,
                    'type' => $item->type. ': '. $item->note,
                    'entree_cdf' => $item->nature === 'entree' && $item->devise->code === 'CDF' ? $item->montant : 0,
                    'entree_usd' => $item->nature === 'entree' && $item->devise->code === 'USD' ? $item->montant : 0,
                    'entree_eur' => $item->nature === 'entree' && $item->devise->code === 'EUR' ? $item->montant : 0,
                    'entree_cfa' => $item->nature === 'entree' && $item->devise->code === 'CFA' ? $item->montant : 0,
                    'sortie_cdf' => $item->nature === 'sortie' && $item->devise->code === 'CDF' ? $item->montant : 0,
                    'sortie_usd' => $item->nature === 'sortie' && $item->devise->code === 'USD' ? $item->montant : 0,
                    'sortie_eur' => $item->nature === 'sortie' && $item->devise->code === 'EUR' ? $item->montant : 0,
                    'sortie_cfa' => $item->nature === 'sortie' && $item->devise->code === 'CFA' ? $item->montant : 0,
                ];
            }
        }

        // dd($tableData);

        return $tableData;
    }

    public function export($user, $date = null)
    {
        // dd($date);
        $rapports = $this->getEcrituresForTable($user, $date);
        $name = User::find($user)->name;
        $date = $date? $date : now()->toDateString();


        Notification::make()
            ->title('Votre rapport est expoté avec succès !')
            ->body("Actualisez pour réafficher les donnees.")
            ->color('success')
            ->duration(5000)
            ->success()
            ->send();
        return Excel::download(new EcritureExport($rapports, $date), 'rapport_'.$name.'_' . $date . '.xlsx');
    }

}
