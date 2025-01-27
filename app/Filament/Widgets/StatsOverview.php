<?php

namespace App\Filament\Widgets;

use App\Models\Shop;
use App\Models\User;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total des boutiques', Shop::count()),
            Stat::make('Boutiques visibles', Shop::where('status', 1)->count()),
            Stat::make('Boutiques masquées', Shop::where('status', 0)->count()),

            Stat::make('Total des catégories', Category::count()),
            Stat::make('Catégories visibles', Category::where('is_visible', 1)->count()),
            Stat::make('Catégories masquées', Category::where('is_visible', 0)->count()),

            Stat::make('Total d\'utilisateurs', User::count()),
            Stat::make('Total des clients', User::where('role', 'customer')->count()),
            Stat::make('Total des vendeurs', User::where('role', 'seller')->count()),
        ];
    }
}
