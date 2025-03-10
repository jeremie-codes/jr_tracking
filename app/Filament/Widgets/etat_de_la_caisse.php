<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\PlusieurMouvement;
use Illuminate\Database\Eloquent\Builder;

class etat_de_la_caisse extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getTableHeading(): string
    {
        return 'État de la Caisse';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getBalanceQuery())
            ->defaultSort('devise_id', 'desc')
            ->paginated(false)
            ->defaultPaginationPageOption(5)
            ->columns([
                Tables\Columns\TextColumn::make('devise.code')
                    ->label('Devise'),
                Tables\Columns\TextColumn::make('balance')
                    ->label('Solde')
                    ->formatStateUsing(function ($state) {
                        return number_format($state, 2);
                    }),
            ]);
    }

    protected function getBalanceQuery(): Builder
    {
        return PlusieurMouvement::query()
            ->selectRaw('devise_id, SUM(CASE WHEN nature = "entree" THEN montant ELSE -montant END) as balance, CONCAT(devise_id, "-", UUID()) as id')
            ->groupBy('devise_id');
    }
}
