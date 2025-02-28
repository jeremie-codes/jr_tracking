<?php

namespace App\Filament\Clusters\Ecriture\Resources;

use App\Filament\Clusters\Ecriture;
use App\Filament\Clusters\Ecriture\Resources\EntréeResource\Pages;
use App\Filament\Clusters\Ecriture\Resources\EntréeResource\RelationManagers;
use App\Models\Entrée;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\CreateRecord;

class EntréeResource extends Resource
{
    protected static ?string $model = Entrée::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Ecriture::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                ->schema([
                    Select::make('type')
                        ->required()
                        ->options([
                            'Consignation' => 'Consignation',
                            'Paiement dette' => 'Paiement dette',
                            'Manquant retrouvé' => 'Manquant retrouvé',
                            'Approvisionnement' => 'Approvisionnement',
                            'Autres' => 'Autres',
                        ]),
                    TextInput::make('auteur')
                        ->numeric("Nom du client")
                        ->numeric()
                        ->default(0)
                        ->required(),
                ]),
            Section::make('Détail')
                ->schema([
                    TextInput::make('montant')
                        ->numeric()
                        ->default(0)
                        ->required(),
                    Select::make('devise_id')
                        ->required()
                        ->options([
                            'Dépense' => 'Dépense',
                            'Recette' => 'Recette',
                        ])
                        ->default('Dépense'),
                    TextInput::make('montant')
                        ->numeric()
                        ->default(0)
                        ->required(),
                ]),
            ]);
    }

    // 'nature',
    // 'type',
    // 'montant',
    // 'devise_id',
    // 'auteur',
    // 'article',
    // 'motif',
    // 'note',
    // 'date_ref',

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListEntrées::route('/'),
            'create' => Pages\CreateEntrée::route('/create'),
            'edit' => Pages\EditEntrée::route('/{record}/edit'),
        ];
    }
}
