<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndicateurResource\Pages;
use App\Filament\Resources\IndicateurResource\RelationManagers;
use App\Models\Indicateur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;

class IndicateurResource extends Resource
{
    protected static ?string $model = Indicateur::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->sortable()
                    ->limit(10)
                    ->searchable(),
                TextColumn::make("montant")
                ->label("Montant")
                ->formatStateUsing(function ($record) {
                    return $record->montant . ' ' . $record->devise->code;
                }),
                TextColumn::make('date_ref')->label("Date reference"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListIndicateurs::route('/'),
            'create' => Pages\CreateIndicateur::route('/create'),
            'edit' => Pages\EditIndicateur::route('/{record}/edit'),
        ];
    }
}
