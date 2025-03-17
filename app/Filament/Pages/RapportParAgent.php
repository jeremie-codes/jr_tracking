<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Tables;
use App\Models\Devise;
use Filament\Pages\Page;
use App\Models\PlusieurMouvement;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EcritureExport;

class RapportParAgent extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = "Rapports";
    protected static ?int $navigationSort = 3;
    protected static string $view = 'filament.pages.rapport-par-agent';

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

    public function export($user, $date = null)
    {
        // dd($date);
        $rapports = $this->getEcrituresForTable($user, $date);
        $name = User::find($user)->name;
        $date = $date? $date : now()->toDateString();

        return Excel::download(new EcritureExport($rapports, $date), 'rapport_'.$name.'_' . $date . '.xlsx');
    }

}
