<?php

namespace App\Filament\Resources\ProfilResource\Pages;

use Filament\Resources\Pages\Page;
use App\Filament\Resources\ProfilResource;
use Illuminate\Support\Facades\Auth;

class RedirectToEdit extends Page
{
    protected static string $resource = ProfilResource::class;

    public function mount()
    {
        $userId = Auth::id();
        return redirect(static::getResource()::getUrl('edit', ['record' => $userId]));
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }
}
