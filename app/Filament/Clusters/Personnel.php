<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Personnel extends Cluster
{
    protected static ?string $navigationGroup = 'Configurations';
    protected static ?int $sort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
}
