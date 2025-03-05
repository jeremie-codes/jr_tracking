<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use App\Models\PlusieurMouvement;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource;
use App\Filament\Clusters\Ecriture\Resources\SortieResource;
use App\Filament\Clusters\Ecriture\Resources\EntréeResource;

class recente extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 6;
    public function table(Table $table): Table
    {
        return $table
            ->query(PlusieurMouvementResource::getEloquentQuery())
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->limit(10),
                Tables\Columns\TextColumn::make("article.name")->label("Article"),
                Tables\Columns\TextColumn::make("montant")
                ->label("Montant")
                ->formatStateUsing(function ($record) {
                    return $record->montant . ' ' . $record->devise->code;
                }),
                Tables\Columns\TextColumn::make('created_at')->label("Heure"),
            ])
            ->actions([
                Tables\Actions\Action::make('Voir')
                    ->url(fn (PlusieurMouvement $record): string => $record->nature === 'sortie' ? SortieResource::getUrl('edit', ['record' => $record]) : EntréeResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
