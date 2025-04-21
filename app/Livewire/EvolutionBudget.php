<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Budget;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Htmlable;

class EvolutionBudget extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected int | string | array $columnSpan = 'full';

    public function getHeading(): string|Htmlable|null
    {
        return 'Evolution graphic de septs derniers jours';
    }

    protected function getData(): array
    {

        $reportFinal = collect();

        Carbon::setLocale('fr'); // Pour avoir les jours en français

        $jours = collect();
        $dates = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $jours->push($date->translatedFormat('l')); // "l" = nom complet du jour
            $dates->push($date);
        }

        // dd(app('App\\Filament\\Widgets\\Budgets')->getReportFinal($dates[6]));

        for ($i = 0; $i < $jours->count(); $i++) {
            $reportFinal->push(app('App\\Filament\\Widgets\\Budgets')->getReportFinal($dates[$i]));
        }

        return [
            'datasets' => [
                [
                    'label' => 'Chiffre d\'affaire',
                    'data' => $reportFinal,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $jours,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
