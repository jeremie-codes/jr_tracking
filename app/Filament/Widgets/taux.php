<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Clusters\Monaie\Resources\DeviseResource;
use App\Models\Taux as ModelsTaux;
use Illuminate\Database\Eloquent\Builder;

class taux extends BaseWidget
{
    protected static ?int $sort = 3;
    public function table(Table $table): Table
    {

        return $table
            ->emptyStateHeading('Aucune devise trouvée !')
            // ->query(TauxResource::getEloquentQuery()->with('devise_source', function($query) {
            //     $query->where('code', 'USD');
            // }))
            ->query($this->getTauxQuery())
            ->defaultSort('created_at', 'ASC')
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Devise'),
                Tables\Columns\TextColumn::make('taux_achat'),
                Tables\Columns\TextColumn::make('taux_vente')
            ]);
    }

    protected function getTauxQuery(): Builder
    {
        return ModelsTaux::query()
            ->leftJoin('devises', 'devise_source_id', '=', 'devises.id')
            ->selectRaw('devises.id as id, devises.code as code, devise_cible_id as codes, taux_achat, taux_vente, taux.created_at as created_at')
            ->where('code', '!=', 'CDF')->where('taux_achat', '>', '2')->limit(1);
    }

}
