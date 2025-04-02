<?php

namespace App\Filament\Resources\VerifierRetraitResource\Pages;

use App\Filament\Resources\VerifierRetraitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVerifierRetrait extends EditRecord
{
    protected static string $resource = VerifierRetraitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
