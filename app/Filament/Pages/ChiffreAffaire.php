<?php

namespace App\Filament\Pages;

use App\Models\Budget;
use Filament\Pages\Page;
use App\Filament\Widgets\Budgets;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use App\Livewire\EvolutionBudget;
class ChiffreAffaire extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    protected static string $view = 'filament.pages.chiffre-affaire';

    use HasFiltersForm;

    public function getTitle(): string
    {
        return 'Chiffre d\'Affaire';
    }

    protected function getHeaderWidgets(): array
    {
        return [
            Budgets::class,
            EvolutionBudget::class
        ];
    }

}
