<?php

namespace App\Filament\Widgets;

use App\Models\Devise;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\PlusieurMouvement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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
                Tables\Columns\TextColumn::make('code')
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
        return Devise::query()
            ->leftJoin('ecritures', 'devises.id', '=', 'ecritures.devise_id')
            ->selectRaw('devises.id as devise_id, devises.code, COALESCE(SUM(CASE WHEN ecritures.nature = "entree" THEN ecritures.montant ELSE -ecritures.montant END), 0) as balance, CONCAT(devises.id, "-", UUID()) as id')
            ->where('user_id', Auth::user()->id)->orWhere('auteur', Auth::user()->nom)
            ->groupBy('devises.id', 'devises.code');
    }
}
