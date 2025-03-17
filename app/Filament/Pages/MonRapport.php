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

    public function getEcrituresForTable($selectedDate = null)
    {
        $date = $selectedDate ? $selectedDate : now()->toDateString(); // Utilise la date sélectionnée ou celle d'aujourd'hui
        // dd($date);
        $query = PlusieurMouvement::where('user_id', Auth::user()->id)
            ->whereDate('created_at', $date)
            ->with('devise')
            ->get();

        $tableData = [];

        foreach ($query as $item) {
            $row = [
                'libelle' => $item->type,
                'entree_cdf' => $item->nature === 'entree' && $item->devise->code === 'CDF' ? $item->montant : '',
                'entree_usd' => $item->nature === 'entree' && $item->devise->code === 'USD' ? $item->montant : '',
                'entree_eur' => $item->nature === 'entree' && $item->devise->code === 'EUR' ? $item->montant : '',
                'entree_cfa' => $item->nature === 'entree' && $item->devise->code === 'CFA' ? $item->montant : '',
                'sortie_cdf' => $item->nature === 'sortie' && $item->devise->code === 'CDF' ? $item->montant : '',
                'sortie_usd' => $item->nature === 'sortie' && $item->devise->code === 'USD' ? $item->montant : '',
                'sortie_eur' => $item->nature === 'sortie' && $item->devise->code === 'EUR' ? $item->montant : '',
                'sortie_cfa' => $item->nature === 'sortie' && $item->devise->code === 'CFA' ? $item->montant : '',
            ];

            $tableData[] = $row;
        }

        return $tableData;
    }

    public function export($date = null)
    {
        $rapports = $this->getEcrituresForTable($date);
        $name = User::find(Auth::user()->id)->name;
        $date = $date? $date : now()->toDateString();

        return Excel::download(new EcritureExport($rapports, $date), 'rapport_'.$name.'_' . $date . '.xlsx');
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

        // foreach ($balances as $deviseCode => $balance) {
        //     if ($balance > 0) {
        //         $deviseId = Devise::where('code', $deviseCode)->first()->id;
        //         Indicateur::create([
        //             'user_id' => Auth::user()->id,
        //             'libelle' => Auth::user()->name,
        //             'devise_id' => $deviseId,
        //             'type' => 'manquant',
        //             'montant'=> $balance,
        //             'date_ref'=> today(),
        //         ]);
        //     }
        //     elseif ($balance < 0) {
        //         $deviseId = Devise::where('code', $deviseCode)->first()->id;
        //         Indicateur::create([
        //             'user_id' => Auth::user()->id,
        //             'libelle' => Auth::user()->name,
        //             'devise_id' => $deviseId,
        //             'type' => 'excédent',
        //             'montant'=> $balance,
        //             'date_ref'=> today(),
        //         ]);
        //     }
        // }

        Notification::make()
            ->title('Votre rapport est envoyé avec succès !')
            ->body("L'administrateur pourra le voir")
            ->color('success')
            ->duration(5000)
            ->success()
            ->send();
    }

}
