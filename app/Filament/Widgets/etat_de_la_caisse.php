<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource;

class etat_de_la_caisse extends BaseWidget
{

    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(PlusieurMouvementResource::getEloquentQuery())
            ->defaultSort('devise_id', 'desc')
            ->paginated(false)
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('Devise.code'),
            Tables\Columns\TextColumn::make("montant")
                ->label("Solde")
            ]);
    }
}
