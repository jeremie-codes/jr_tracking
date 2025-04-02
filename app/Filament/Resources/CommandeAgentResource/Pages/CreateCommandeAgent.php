<?php

namespace App\Filament\Resources\CommandeAgentResource\Pages;

use App\Filament\Resources\CommandeAgentResource;
use App\Filament\Resources\CommandeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateCommandeAgent extends CreateRecord
{
    protected static string $resource = CommandeAgentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
