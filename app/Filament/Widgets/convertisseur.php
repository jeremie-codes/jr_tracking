<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class convertisseur extends Widget
{
    protected static string $view = 'filament.widgets.convertisseur';
    protected static ?int $sort = 6;

    public function getDevises()
    {
        $devises = App\Models\Devise::all();
    }
}
