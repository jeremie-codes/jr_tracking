<?php

namespace App\Filament\Clusters\Monaie\Resources\DeviseResource\Pages;

use App\Filament\Clusters\Monaie\Resources\DeviseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDevise extends EditRecord
{
    protected static string $resource = DeviseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
