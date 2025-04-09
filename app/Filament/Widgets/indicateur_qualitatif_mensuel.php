<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Number;
use App\Models\Indicateur;
use App\Models\Presence;
use App\Models\Taux;
use Illuminate\Support\Facades\Auth;
use App\Models\Devise;

class indicateur_qualitatif_mensuel extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $userId = Auth::user()->id;
        $deviseDeReference = 'USD'; // Devise de référence pour la conversion

        // START - Récupérer les données de dette et de paiement par devise

        // Récupérer les données de dette et de paiement par devise
        $tot_dette = Indicateur::where('user_id', $userId)
            ->where('type', 'dette')
            ->selectRaw('devise_id, SUM(montant) as total_dette')
            ->groupBy('devise_id')
            ->get();

        $tot_paie = Indicateur::where('user_id', $userId)
            ->where('type', 'paiement')
            ->selectRaw('devise_id, SUM(montant) as total_paie')
            ->groupBy('devise_id')
            ->get();

        // Calculer la dette non payée par devise
        $detteNonPayee = $tot_dette->map(function ($dette) use ($tot_paie) {
            $paiement = $tot_paie->firstWhere('devise_id', $dette->devise_id);
            $total_paie = $paiement ? $paiement->total_paie : 0;
            return [
                'devise_id' => $dette->devise_id,
                'dette_non_payee' => $dette->total_dette - $total_paie,
            ];
        });

        // Convertir les dettes non payées dans la devise de référence
        $totalDetteNonPayee = $detteNonPayee->reduce(function ($carry, $item) use ($deviseDeReference) {
            $devise = Devise::find($item['devise_id']);
            if ($devise->code !== $deviseDeReference) {
                $taux = Taux::where('devise_source_id', Devise::where('code', $deviseDeReference)->first()->id)
                    ->where('devise_cible_id', Devise::where('code', $devise->code)->first()->id)->first();
                $montantConverti = $item['dette_non_payee'] * 1 / ($taux ? $taux->taux_vente : 1);
                    // dd($taux->taux_vente);
            } else {
                $montantConverti = $item['dette_non_payee'];
            }
            return $carry + $montantConverti;
        }, 0);

        // END - Récupérer les données de dette et de paiement par devise

        // START - Récupérer les données de manquant par devise
        $tot_manquant = Indicateur::where('user_id', $userId)
            ->where('type','manquant')
            ->selectRaw('devise_id, SUM(montant) as total_manquant')
            ->groupBy('devise_id')
            ->get();

        // Convertir les marchandises dans la devise de référence
        $totalMaquant = $tot_manquant->reduce(function ($carry, $item) use ($deviseDeReference) {
            $devise = Devise::find($item['devise_id']);
            if ($devise->code!== $deviseDeReference) {
                $taux = Taux::where('devise_source_id', Devise::where('code', $deviseDeReference)->first()->id)
                    ->where('devise_cible_id', Devise::where('code', $devise->code)->first()->id)->first();
                $montantConverti = $item['total_manquant'] * 1 / ($taux? $taux->taux_vente : 1);
            } else {
                $montantConverti = $item['total_manquant'];
            }
            return $carry + $montantConverti;
        }, 0);

        // dd($tot_manquant);
        // END - Récupérer les données de mnaquant par devise

        // START - Récupérer les données d'absence par mois
        $absence = Presence::where('user_id', $userId)
            ->where('absent', true)
            ->whereMonth('created_at', Carbon::now()->month)
            ->selectRaw('COUNT(*) as total_absence')
            ->first();

        // END - Récupérer les données d'absence par mois

        // START - Récupérer les données de retard par mois
        $retard = Presence::where('user_id', $userId)
            ->where('retard', true)
            ->whereMonth('created_at', Carbon::now()->month)
            ->selectRaw('COUNT(*) as total_retard')
            ->first();

        // END - Récupérer les données de retard par mois

        $formatNumber = function ($number): string {
            if ($number < 1000) {
                return round($number, 2);
            }

            if ($number < 1000000) {
                return Number::format($number / 1000, 2) . 'k';
            }

            return Number::format($number / 1000000, 2) . 'm';
        };

        // Formater le résultat pour l'affichage
        $stats = [
            Stat::make('Manquants', '$'. $formatNumber($totalMaquant))
                ->description('Manquant trouvé converti en ' . $deviseDeReference)
                ->descriptionIcon($totalMaquant > 0 ? 'heroicon-m-arrow-trending-down': 'heroicon-o-check')
                ->chart([2, 1, 3, 2,])
                ->color($totalMaquant > 0 ? 'danger' : 'success'),
            Stat::make('Dettes non payées', '$'. $formatNumber($totalDetteNonPayee))
                ->description('Total dette non payée convertie en ' . $deviseDeReference)
                ->descriptionIcon($totalDetteNonPayee > 0 ? 'heroicon-m-arrow-trending-down': 'heroicon-o-check')
                ->chart([2, 1, 3, 2,])
                ->color($totalDetteNonPayee > 0 ? 'danger' : 'success'),
            Stat::make('Absences', $absence->total_absence .' Jr')
                ->description('Nombre de jour d\'absence ce mois-ci')
                ->descriptionIcon($absence->total_absence > 0 ? 'heroicon-m-arrow-trending-down': 'heroicon-o-check')
                ->chart([2, 1, 3, 2,])
                ->color($absence->total_absence > 0 ? 'danger' : 'success'),
            Stat::make('Retards', $retard->total_retard .' Jr')
                ->description('Nombre de jour de retard ce mois-ci')
                ->descriptionIcon($retard->total_retard > 0 ? 'heroicon-m-arrow-trending-down': 'heroicon-o-check')
                ->chart([2, 1, 3, 2,])
                ->color($retard->total_retard > 0 ? 'danger' : 'success'),
        ];

        return $stats;
    }
}
