<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Personnel extends Cluster
{
    protected static ?string $navigationGroup = 'Configurations';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
}
