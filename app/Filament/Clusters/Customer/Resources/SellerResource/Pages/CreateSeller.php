<?php

namespace App\Filament\Clusters\Customer\Resources\SellerResource\Pages;

use App\Models\Shop;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Customer\Resources\SellerResource;

class CreateSeller extends CreateRecord
{
    protected static string $resource = SellerResource::class;
    protected static ?string $title = 'Ajouter un vendeur';
    protected $shop_name;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->shop_name = $data['shop']['name'];

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;

        // dd($record);

        $shop = Shop::create([
            'user_id' => $record->id,
            'name' => $this->shop_name,
        ]);
    }
}
