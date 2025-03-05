<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Clusters\Monaie\Resources\TauxResource;

class taux extends BaseWidget
{
    protected static ?int $sort = 0;
    public function table(Table $table): Table
    {

        return $table
            ->query(TauxResource::getEloquentQuery())
            ->defaultSort('created_at', 'desc')
            // ->defaultPaginationPageOption(5)
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('devise.code')
                    ->label('Devise'),
                Tables\Columns\TextColumn::make('achat'),
                Tables\Columns\TextColumn::make('vente')
            ]);
    }
}
