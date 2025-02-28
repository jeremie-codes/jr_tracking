<?php

namespace App\Filament\Clusters\Monaie\Resources;

use App\Filament\Clusters\Monaie;
use App\Filament\Clusters\Monaie\Resources\TauxResource\Pages;
use App\Filament\Clusters\Monaie\Resources\TauxResource\RelationManagers;
use App\Models\Taux;
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
            Section::make('Taux')
                ->schema([
                    Select::make('devise_id')
                        ->options([
                            'C-Abonné'=> 'C-Abonné',
                            'C-Agent'=> 'C-Agent',
                            'Operateur'=> 'Operateur',
                            'Admin'=> 'Administrateur',
                        ])
                        ->required(),
                    TextInput::make('vente')
                        ->required()
                        ->numeric(),
                        TextInput::make('achat')
                        ->required()
                        ->numeric(),

                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("code"),
                TextColumn::make("nom")
                    ->label("Designation")
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
