<?php

namespace App\Filament\Resources\IndicateurResource\Pages;

use App\Filament\Resources\IndicateurResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndicateur extends EditRecord
{
    protected static string $resource = IndicateurResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Redirige vers la liste des utilisateurs après la création
        return $this->getResource()::getUrl('index');
    }
}
