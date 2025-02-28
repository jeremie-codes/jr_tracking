<?php

namespace App\Filament\Clusters\Monaie\Resources\TauxResource\Pages;

use App\Filament\Clusters\Monaie\Resources\TauxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaux extends EditRecord
{
    protected static string $resource = TauxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
