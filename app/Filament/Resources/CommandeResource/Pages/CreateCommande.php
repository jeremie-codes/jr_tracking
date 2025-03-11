<?php

namespace App\Filament\Resources\CommandeResource\Pages;

use App\Filament\Resources\CommandeResource;
use Filament\Resources\Pages\CreateRecord;
use App\Notifications\NewCommandeNotification;

class CreateCommande extends CreateRecord
{
    protected static string $resource = CommandeResource::class;

    // protected function afterCreate(): void
    // {
    //     $user = $this->record->user;
    //     $user->notify(new NewCommandeNotification($this->record));
    // }
}
