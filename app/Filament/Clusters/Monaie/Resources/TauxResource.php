<?php

namespace App\Filament\Clusters\Monaie\Resources;

use App\Filament\Clusters\Monaie;
use App\Filament\Clusters\Monaie\Resources\TauxResource\Pages;
use App\Filament\Clusters\Monaie\Resources\TauxResource\RelationManagers;
use App\Models\Taux;
use App\Models\Devise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class TauxResource extends Resource
{
    protected static ?string $model = Taux::class;

    protected static ?string $label = 'Taux';
    protected static ?string $pluralLabel = 'Taux';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Monaie::class;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Devise')
                ->schema([
                    Select::make('devise_source_id')
                        ->label('Source')
                        ->prefix('1')
                        ->options(Devise::pluck('code', 'id')->toArray())
                        ->required('Choisir')
                        ->required(),
                    Select::make('devise_cible_id')
                        ->label('Cible')
                        ->options(Devise::pluck('code', 'id')->toArray())
                        ->required('Choisir')
                        ->reactive()
                        ->required()

                ])->columns(2),
            Section::make('Taux de Change')
                ->schema([
                    TextInput::make('taux_vente')
                        ->required()
                        ->numeric()
                        ->prefix(fn ($get) => $get('devise_cible_id') > 0 ? Devise::select('code')->where('id', $get('devise_cible_id'))->get()->first()->code : ''),
                        TextInput::make('taux_achat')
                        ->required()
                        ->numeric()
                        ->prefix(fn ($get) => $get('devise_cible_id') > 0 ? Devise::select('code')->where('id', $get('devise_cible_id'))->get()->first()->code : ''),

                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("devise_source.code")
                    ->label("Devise Source"),
                TextColumn::make("devise_cible.code")
                    ->label("Devise cible"),
                TextColumn::make("taux_vente")
                    ->label("Taux Vente"),
                TextColumn::make("taux_achat")
                    ->label("Taux Achat"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
                Tables\Actions\DeleteAction::make()->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Tout Supprimer'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTauxes::route('/'),
            'create' => Pages\CreateTaux::route('/create'),
            'edit' => Pages\EditTaux::route('/{record}/edit'),
        ];
    }
}
