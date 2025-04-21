<?php

namespace App\Filament\Clusters\Monaie\Resources;

use App\Filament\Clusters\Monaie;
use App\Filament\Clusters\Monaie\Resources\DeviseResource\Pages;
use App\Filament\Clusters\Monaie\Resources\DeviseResource\RelationManagers;
use App\Models\Devise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\Page;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class DeviseResource extends Resource
{
    protected static ?string $model = Devise::class;

    protected static ?string $navigationIcon = 'heroicon-s-currency-dollar';

    protected static ?string $cluster = Monaie::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Devise')
                    ->schema([
                        TextInput::make('code')
                            ->required()
                            ->maxLength(10),
                        TextInput::make('nom')
                            ->label("Designation")
                            ->required(),

                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->defaultSort('id', 'desc')
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
            'index' => Pages\ListDevises::route('/'),
            'create' => Pages\CreateDevise::route('/create'),
            'edit' => Pages\EditDevise::route('/{record}/edit'),
        ];
    }
}
