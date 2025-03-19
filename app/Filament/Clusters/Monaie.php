<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Monaie extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Configurations';
    protected static ?int $navigationSort = 1;

}
