<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Commande;
use App\Models\Devise;
use App\Models\Article;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Exports\TransactExport;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class RapportDeTransactions extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    // protected static ?string $titre = "Rapport de Transactions";

    protected static string $view = 'filament.pages.historique-des-transactions';
    protected static ?string $navigationGroup = "Rapports";

    protected static ?int $navigationSort = 3;

    public $devises = array();

    public function __construct() {
        $this->devises['cdf'] = Devise::where('code', 'CDF')->get()->first()->code ?? null;
        $this->devises['usd'] = Devise::where('code', 'USD')->get()->first()->code ?? null;

         // Filtrage des éléments avec valeur non nulle
        $this->devises = array_filter($this->devises, function($value) {
            return !is_null($value); // Ne garde que les éléments non nuls
        });
    }

    public function getArticlesWithTransaction()
    {
        $tasks = User::where('id', Auth::user()->id)->pluck('tasks')[0];

        if(Auth::user()->role === "Admin") {
            return Article::where('name', '!=', 'Autres')->where('name', '!=', 'Cash')->get();
        }
        return Article::whereIn('name', $tasks)->get();
    }

    public function getTransactionForTable($articleId, $selectedDate = null)
    {
        $date = $selectedDate ? $selectedDate : now()->toDateString();

        $query = Commande::where('article_id', $articleId)
            ->whereDate('created_at', $date)
            ->where(function($query) {
                $query->where('user_id', Auth::user()->id)
                ->orWhere('person_id', Auth::user()->id);
            })
            ->where(function($query) {
                $query->where('type', 'depot')
                ->orWhere('type', 'retrait');
            })
            ->where('status', 'approuvée')
            ->with('devise')
            ->get();

        if(Auth::user()->role === "Admin") {
            $query = Commande::where('article_id', $articleId)
            ->whereDate('created_at', $date)
            ->where(function($query) {
                $query->where('type', 'depot')
                ->orWhere('type', 'retrait');
            })
            ->where('status', 'approuvée')
            ->with('devise')
            ->get();
        }

        $tableData = [];

        foreach ($query as $item) {

            $tableData[] = [
                'id' => $item->id,
                'client' => $item->agent_name,
                'numero' => $item->numero,
                'depot_cdf' => $item->type === 'depot' && $item->devise->code === 'CDF' ? $item->montant : 0,
                'depot_usd' => $item->type === 'depot' && $item->devise->code === 'USD' ? $item->montant : 0,
                'depot_eur' => $item->type === 'depot' && $item->devise->code === 'EUR' ? $item->montant : 0,
                'depot_cfa' => $item->type === 'depot' && $item->devise->code === 'CFA' ? $item->montant : 0,
                'retrait_cdf' => $item->type === 'retrait' && $item->devise->code === 'CDF' ? $item->montant : 0,
                'retrait_usd' => $item->type === 'retrait' && $item->devise->code === 'USD' ? $item->montant : 0,
                'retrait_eur' => $item->type === 'retrait' && $item->devise->code === 'EUR' ? $item->montant : 0,
                'retrait_cfa' => $item->type === 'retrait' && $item->devise->code === 'CFA' ? $item->montant : 0,
            ];
        }

        return $tableData;
    }

    public function getCalculFinal($selectedDate = null)
    {
        $date = $selectedDate ? $selectedDate : now()->toDateString();

        $cdfId = Devise::where('code', 'CDF')->first()->id;
        $usdId = Devise::where('code', 'USD')->first()->id;

        $depotCdf = Commande::whereDate('created_at', $date)
            ->where('type', 'depot')
            ->where('status', 'approuvée')
            ->where('devise_id', $cdfId)
            ->get();

        $depotUsd = Commande::whereDate('created_at', $date)
            ->where('type', 'depot')
            ->where('status', 'approuvée')
            ->where('devise_id', $usdId)
            ->get();

        $retraitCdf = Commande::whereDate('created_at', $date)
            ->where('type', 'retrait')
            ->where('status', 'approuvée')
            ->where('devise_id', $cdfId)
            ->get();

        $retraitUsd = Commande::whereDate('created_at', $date)
            ->where('type', 'retrait')
            ->where('status', 'approuvée')
            ->where('devise_id', $usdId)
            ->get();

        $tableData = [
            'depot_cdf' => $depotCdf->sum('montant') ?? 0,
            'depot_usd' => $depotUsd->sum('montant') ?? 0,
            'retrait_cdf' => $retraitCdf->sum('montant') ?? 0,
            'retrait_usd' => $retraitUsd->sum('montant') ?? 0,
        ];


        return $tableData;
    }

    public function export($date = null)
    {
        $transacts = $this->getTransactionForTable($date);
        $date = $date? $date : now()->toDateString();

        Notification::make()
            ->title('Votre rapport est expoté avec succès !')
            ->body("Actualisez pour réafficher les données.")
            ->color('success')
            ->duration(5000)
            ->success()
            ->send();

        return Excel::download(new TransactExport($transacts, $date), 'Rapport_transaction_' . $date . '.xlsx');
    }

}
