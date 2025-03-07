<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Support\Number;
use App\Models\PlusieurMouvement;
use App\Models\Indicateur;
use Illuminate\Support\Facades\Auth;
use App\Models\Devise;

class indicateur_qualitatif_mensuel extends BaseWidget
{

    use InteractsWithPageFilters;
    protected static ?int $sort = 1;

    protected function getStats(): array
    {

        $userId = Auth::user()->id;

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

        // Formater les résultats pour l'affichage
        $stats = $detteNonPayee->map(function ($item) {
            $devise = Devise::find($item['devise_id']);
            return Stat::make('Dette non payée (' . $devise->code . ')', $item['dette_non_payee'])
                ->description('Dette non payée en ' . $devise->code)
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger');
        })->toArray();

        return $stats;

        // $formatNumber = function (int $number): string {
        //     if ($number < 1000) {
        //         return (string) Number::format($number, 0);
        //     }

        //     if ($number < 1000000) {
        //         return Number::format($number / 1000, 2) . 'k';
        //     }

        //     return Number::format($number / 1000000, 2) . 'm';
        // };

        // return [
        //     Stat::make('Manquant', '$' . $tot)
        //         ->description('32k increase')
        //         ->descriptionIcon('heroicon-m-arrow-trending-up')
        //         ->chart([7, 2, 10, 3, 15, 4, 17])
        //         ->color('success'),
        //     Stat::make('Dette non récuperé', $formatNumber($newCustomers))
        //         ->description('3% decrease')
        //         ->descriptionIcon('heroicon-m-arrow-trending-down')
        //         ->chart([17, 16, 14, 15, 14, 13, 12])
        //         ->color('danger'),
        //     Stat::make('Absences', $formatNumber($newOrders))
        //         ->description('7% increase')
        //         ->descriptionIcon('heroicon-m-arrow-trending-up')
        //         ->chart([15, 4, 10, 2, 12, 4, 12])
        //         ->color('success'),
        //     Stat::make('Retard', $formatNumber($newOrders))
        //         ->description('7% increase')
        //         ->descriptionIcon('heroicon-m-arrow-trending-up')
        //         ->chart([15, 4, 10, 2, 12, 4, 12])
        //         ->color('success'),
        // ];
    }
}
