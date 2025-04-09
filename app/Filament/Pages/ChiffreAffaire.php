<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class ChiffreAffaire extends Page
{
    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    protected static string $view = 'filament.pages.chiffre-affaire';

    public function getTitle(): string
    {
        return 'Chiffre d\'Affaire';
    }

}
