<?php

namespace App\Filament\Clusters\Customer\Resources\ShopResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Clusters\Customer\Resources\ShopResource;
use App\Filament\Clusters\Customer\Resources\ShopResource\Widgets\ShopsOverview;

class ListShops extends ListRecords
{
    protected static string $resource = ShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ShopsOverview::class,
        ];
    }
}
