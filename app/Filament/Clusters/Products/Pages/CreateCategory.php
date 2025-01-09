<?php

namespace App\Filament\Clusters\Products\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Clusters\Products\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
    protected static ?string $title = 'Ajouter une catégorie';
}
