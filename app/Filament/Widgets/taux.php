<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Clusters\Monaie\Resources\TauxResource;

class taux extends BaseWidget
{
    protected static ?int $sort = 3;
    public function table(Table $table): Table
    {

        return $table
            ->emptyStateHeading('Aucune devise trouvée !')
            ->query(TauxResource::getEloquentQuery())
            ->defaultSort('created_at', 'ASC')
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('devise_source.code')
                    ->label('Devise'),
                Tables\Columns\TextColumn::make('taux_achat'),
                Tables\Columns\TextColumn::make('taux_vente')
            ]);
    }
}
