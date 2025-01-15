<?php

namespace App\Filament\Clusters\Products\ProductResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Products\ProductResource;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    protected static ?string $title = 'Ajouter un produit';

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     dd($data);
    // }
}
