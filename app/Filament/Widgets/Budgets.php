<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Budget;
use App\Models\Devise;
use App\Models\Indicateur;
use Illuminate\Support\Number;
use App\Models\PlusieurMouvement;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Illuminate\Support\Facades\Request;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class Budgets extends BaseWidget
{

    protected static ?int $sort = 2;

    use InteractsWithPageFilters;

    public function __construct()
    {
        if(Auth::user()->role == 'Admin') {
            $date = now();

            $reportInitial = $this->getReportInitialActuel(Carbon::parse($date));
            $reportFinal = round($this->getReportFinal(Carbon::parse($date)), 2);

            $report = Budget::whereDate('created_at', $date)->first();

            // dd($report->reel_final == $reportFinal);
            if ($report && $report->rep_init == $reportInitial && $report->reel_final == $reportFinal) {
                return;
            }

            Budget::updateOrCreate(
                ['id' => $report->id ?? 0],
                [
                    'rep_init' => $reportInitial,
                    'reel_final' => $reportFinal,
                    'rep_final' => $reportFinal,
                ]
            );
        };
    }

    public function getRepportInitialToBudget(Carbon $date) {
        $report = Budget::whereDate('created_at', $date)
            ->orderByDesc('created_at')
            ->value('rep_final');

        return $report;
    }

    public function getReportInitialActuel(Carbon $date)
    {
        $previousDate = Budget::whereDate('created_at', '<', $date)
            ->orderByDesc('created_at')
            ->value('created_at');

        // dd($previousDate);
        return $previousDate
            // ? $this->getReportFinal(Carbon::parse($previousDate))
            ? $this->getRepportInitialToBudget(Carbon::parse($previousDate))
            : 0;
    }

    public function getReportFinal(Carbon $date)
    {
        $reportInitial = $this->getReportInitialActuel($date);

        $ecrituresJour = PlusieurMouvement::whereDate('created_at', $date)->get();

        $entrees = $ecrituresJour
            ->whereIn('type', ['Consignation', 'Manquant retrouvé', 'Paiement commission'])
            ->sum(function ($ecriture) {
                return $this->convertToDollar($ecriture->montant, $ecriture->devise_id);
            });

        $sorties = $ecrituresJour
            ->whereIn('type', ['Excédent retrouvé', 'Dépenses', 'Remboursement', 'Paiement dette'])
            ->sum(function ($ecriture) {
                return $this->convertToDollar($ecriture->montant, $ecriture->devise_id);
            });

        $indicateurs = Indicateur::whereDate('created_at', $date)->get();

        $excedent = $indicateurs
            ->where('type', 'excédent')
            ->sum(function ($indicateur) {
                return $this->convertToDollar($indicateur->montant, $indicateur->devise_id);
            });

        $manquant = $indicateurs
            ->where('type', 'manquant')
            ->sum(function ($indicateur) {
                return $this->convertToDollar($indicateur->montant, $indicateur->devise_id);
            });

        return $reportInitial + $entrees - $sorties + $excedent - $manquant;
    }

    private function convertToDollar(float $montant, int $deviseCibleId): float
    {

        $deviseSourceId = \App\Models\Devise::where('code', 'USD')->first()->id;

        if ($deviseSourceId === $deviseCibleId) {
            return $montant;
        }

        $taux = \App\Models\Taux::where('devise_source_id', $deviseSourceId)
            ->where('devise_cible_id', $deviseCibleId)
            ->orderByDesc('created_at') // pour prendre le plus récent si jamais
            ->value('taux_vente');

        if (!$taux || $taux == 0) {
            throw new \Exception("Taux non défini entre la devise $deviseSourceId et $deviseCibleId.");
        }

        return $montant * 1 / ($taux? $taux : 1);
    }

    protected function getStats(): array
    {

        $today = $this->filters['date'] ?? now();

        $reportInitial = $this->getReportInitialActuel($today);
        $reelFinal = $this->getReportFinal($today);
        $reportFinal = $this->getReportFinal($today);

        $formatNumber = function ($number): string {
            if ($number < 1000) {
                return round($number, 2);
            }

            if ($number < 1000000) {
                return Number::format($number / 1000, 2) . 'k';
            }

            return Number::format($number / 1000000, 2) . 'M';
        };


        if (Auth::user()->role === "Admin") {
            return [
                Stat::make('Report Initial', '$'. $formatNumber($reportInitial))
                    ->description('$' . round($reportInitial, 2))
                    ->descriptionIcon($reportInitial > 0 ? 'heroicon-o-check' : 'heroicon-m-arrow-trending-down')
                    ->chart([2, 1, 3, 2])
                    ->color($reportInitial > 0 ? 'success': 'warning'),
                Stat::make('Report Final Réel', '$'. $formatNumber($reelFinal))
                    ->description('$' . round($reelFinal, 2))
                    ->descriptionIcon($reelFinal > 0 ? 'heroicon-o-check' : 'heroicon-m-arrow-trending-down')
                    ->chart([2, 1, 3, 2])
                    ->color($reelFinal > 0 ? 'success': 'warning'),
                Stat::make('Report Final Système', '$'. $formatNumber($reportFinal))
                    ->description('$' . round($reportFinal, 2))
                    ->descriptionIcon($reportFinal > 0 ? 'heroicon-o-check' : 'heroicon-m-arrow-trending-down')
                    ->chart([2, 1, 3, 2])
                    ->color($reportFinal > 0 ? 'success': 'warning'),
            ];
        }

        return [];
    }
}
