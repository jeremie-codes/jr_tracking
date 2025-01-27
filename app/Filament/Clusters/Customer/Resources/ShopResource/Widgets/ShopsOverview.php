<?php

namespace App\Filament\Clusters\Customer\Resources\ShopResource\Widgets;

use App\Models\Shop;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ShopsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total boutiques', Shop::count()),
            Stat::make('Boutiques visibles', Shop::where('status', 1)->count()),
            Stat::make('Boutiques masquées', Shop::where('status', 0)->count()),
        ];
    }
}
