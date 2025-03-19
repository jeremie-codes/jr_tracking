<?php

namespace App\Filament\Resources\CommandeResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use App\Filament\Resources\CommandeResource\Pages\ListCommandes;

class StateOrder extends BaseWidget
{

    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected function getTablePage(): string
    {
        return ListCommandes::class;
    }

    protected function getStats(): array
    {
        $request = Commande::where('user_id', Auth::user()->id)
            ->orWhere('person_id', Auth::user()->id)->get();

        if (Auth::user()->role == 'Admin') {
            $request = Commande::all();

        }

        $approved = $request->where('status', 'approuvée')->count();
        $attente = $request->where('status', 'attente')->count();
        $desapprouvée = $request->where('status', 'désapprouvée')->count();


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
            Stat::make('Désapprouvée', $formatNumber($desapprouvée))
                ->chart([1, 0, 1, 0.5])
                ->chartColor('danger'),
        ];
    }
}
