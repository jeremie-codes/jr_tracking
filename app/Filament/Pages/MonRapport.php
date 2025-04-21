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

class MonRapport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';
    protected static ?string $navigationGroup = "Rapports";
    protected static string $view = 'filament.pages.mon-rapport';
    protected static ?int $navigationSort = 3;

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

    public function getEcrituresForTable($selectedDate = null)
    {
        // dd($this->devises);
        $date = $selectedDate ? $selectedDate : now()->toDateString(); // Utilise la date sélectionnée ou celle d'aujourd'hui

        $query = PlusieurMouvement::where('user_id', Auth::user()->id)
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
                    'type' => $item->type == 'Cession de fond' ? 'Appro '. $item->article_id . ', ' . $item->auteur : $item->type . ' '. $item->article_id . ', ' . $item->auteur,
                    'auteur' => $item->user->name,
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

    public function export($date = null)
    {
        $rapports = $this->getEcrituresForTable($date);
        $name = User::find(Auth::user()->id)->name;
        $date = $date? $date : now()->toDateString();

        Notification::make()
            ->title('Votre rapport est expoté avec succès !')
            ->body("Actualisez pour réafficher les donnees.")
            ->color('success')
            ->duration(5000)
            ->success()
            ->send();
        return Excel::download(new EcritureExport($rapports, $date), 'Mon_rapport_' . $date . '.xlsx');
    }

    public function cloture($date = null)
    {
        $total = [
            'entree_cdf' => 0, 'entree_usd' => 0, 'entree_eur' => 0, 'entree_cfa' => 0,
            'sortie_cdf' => 0, 'sortie_usd' => 0, 'sortie_eur' => 0, 'sortie_cfa' => 0,
        ];

        foreach($this->getEcrituresForTable($date) as $ecriture) {
            $total['entree_cdf'] += (float) $ecriture['entree_cdf'] ?? 0;
            $total['entree_usd'] += (float) $ecriture['entree_usd'] ?? 0;
            $total['entree_eur'] += (float) $ecriture['entree_eur'] ?? 0;
            $total['entree_cfa'] += (float) $ecriture['entree_cfa'] ?? 0;
            $total['sortie_cdf'] += (float) $ecriture['sortie_cdf'] ?? 0;
            $total['sortie_usd'] += (float) $ecriture['sortie_usd'] ?? 0;
            $total['sortie_eur'] += (float) $ecriture['sortie_eur'] ?? 0;
            $total['sortie_cfa'] += (float) $ecriture['sortie_cfa'] ?? 0;
        }

        $balances = [
            'CDF' => $total['entree_cdf'] - $total['sortie_cdf'],
            'USD' => $total['entree_usd'] - $total['sortie_usd'],
            'EUR' => $total['entree_eur'] - $total['sortie_eur'],
            'CFA' => $total['entree_cfa'] - $total['sortie_cfa'],
        ];

        foreach ($balances as $deviseCode => $balance) {

            $existedManquant = Indicateur::where('date_ref', $date ?? now()->toDateString())->where('type', 'manquant')->exists();
            $existedExcedent = Indicateur::where('date_ref', $date ?? now()->toDateString())->where('type', 'excédent')->exists();

            if ($balance > 0) {
                $deviseId = Devise::where('code', $deviseCode)->first()->id;

                if ($existedManquant) {
                    $indicateur = Indicateur::where('date_ref', $date ?? now()->toDateString())->where('type', 'manquant')->first();
                    $indicateur->update([
                        'montant' => abs($balance),
                    ]);
                } else{

                    Indicateur::create([
                        'user_id' => Auth::user()->id,
                        'libelle' => Auth::user()->name,
                        'devise_id' => $deviseId,
                        'type' => 'manquant',
                        'montant'=> abs($balance),
                        'date_ref'=> $date ?? now()->toDateString(),
                    ]);
                }
            }
            elseif ($balance < 0) {
                $deviseId = Devise::where('code', $deviseCode)->first()->id;

                if ($existedExcedent) {
                    $indicateur = Indicateur::where('date_ref', $date ?? now()->toDateString())->where('type', 'excédent')->first();
                    $indicateur->update([
                        'montant' => abs($balance),
                    ]);
                }
                else {
                    Indicateur::create([
                        'user_id' => Auth::user()->id,
                        'libelle' => Auth::user()->name,
                        'devise_id' => $deviseId,
                        'type' => 'excédent',
                        'montant'=> abs($balance),
                        'date_ref'=> $date ?? now()->toDateString(),
                    ]);
                }

            }
        }

        Notification::make()
            ->title('Votre rapport est envoyé avec succès !')
            ->body("L'administrateur pourra le voir")
            ->color('success')
            ->duration(5000)
            ->success()
            ->send();
    }

}
