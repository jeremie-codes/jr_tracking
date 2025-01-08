<?php

namespace App\Filament\Clusters\Customer\Resources\ShopResource\Pages;

use App\Filament\Clusters\Customer\Resources\ShopResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShop extends EditRecord
{
    protected static string $resource = ShopResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
