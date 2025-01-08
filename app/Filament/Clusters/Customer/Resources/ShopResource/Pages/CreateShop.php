<?php

namespace App\Filament\Clusters\Customer\Resources\ShopResource\Pages;

use App\Filament\Clusters\Customer\Resources\ShopResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateShop extends CreateRecord
{
    protected static string $resource = ShopResource::class;
    protected static ?string $title = 'Ajouter une boutique';
}
