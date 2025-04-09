<?php

namespace App\Filament\Clusters\Ecriture\Resources\EntréeResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\EntréeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Pages\AllEcriture;

class EditEntrée extends EditRecord
{
    protected static string $resource = EntréeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Supprimer')
        ];
    }

    protected function getRedirectUrl(): string
    {
        return AllEcriture::getUrl();
    }
}
