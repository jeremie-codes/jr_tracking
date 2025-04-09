<?php

namespace App\Filament\Clusters\Ecriture\Resources\EntréeResource\Pages;

use App\Filament\Clusters\Ecriture\Resources\EntréeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use App\Models\Commande;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ListEntrées extends ListRecords
{
    protected static string $resource = EntréeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
