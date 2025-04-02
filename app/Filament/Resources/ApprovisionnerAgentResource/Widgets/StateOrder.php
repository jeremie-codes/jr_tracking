<?php

namespace App\Filament\Resources\ApprovisionnerAgentResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use App\Filament\Resources\ApprovisionnerAgentResource\Pages\ListApprovisionnerAgents;

class StateOrder extends BaseWidget
{

    use InteractsWithPageTable;

    protected static ?string $pollingInterval = "2s";

    protected function getTablePage(): string
    {
        return ListApprovisionnerAgents::class;
    }

    protected function getStats(): array
    {

        // Décoder la structure JSON pour accéder à tableFilters
        $filters = json_decode(request()->input('components.0.snapshot'), true);

        // Extraire la date filtrée ou utiliser la date actuelle par défaut
        $filterDate = now()->toDateString(); // Valeur par défaut : date actuelle
        if (isset($filters['data']['tableFilters'][0]['created_at'][0]['ParDate'])) {
            $filterDate = $filters['data']['tableFilters'][0]['created_at'][0]['ParDate'];
        }

        $request = Commande::whereDate('created_at', $filterDate)
            ->where(function ($query) {
                $query->where('type','approvisionnement');
            })
            ->where(function ($query) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhere('person_id', Auth::user()->id);
            })->get();

        if (Auth::user()->role == 'Admin') {
            $request = Commande::whereDate('created_at', $filterDate)
            ->where(function ($query) {
                $query->where('type','approvisionnement');
            })->get();
        }

        $approved = $request->where('status', 'approuvée')->count();
        $attente = $request->where('status', 'attente')->count();
        $annulée = $request->where('status', 'annulée')->count();


        $formatNumber = function ($number): string {
            if ($number < 1000) {
                return $number;
            }

            if ($number < 1000000) {
                return Number::format($number / 1000, 2) . 'k';
            }

            return Number::format($number / 1000000, 2) . 'm';
        };


        return [
            Stat::make('Approuvé', $formatNumber($approved))
                ->chart([1, 0, 1, 0.5])
                ->chartColor('success'),
            Stat::make('Attente', $formatNumber($attente))
                ->chart([1, 0, 1, 0.5])
                ->chartColor('warning'),
            Stat::make('Annulée', $formatNumber($annulée))
                ->chart([1, 0, 1, 0.5])
                ->chartColor('danger'),
        ];
    }
}
