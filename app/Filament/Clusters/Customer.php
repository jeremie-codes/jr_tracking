<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Customer extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup = 'E-commerce';
    protected static ?string $navigationLabel = 'Vendeurs';

}
