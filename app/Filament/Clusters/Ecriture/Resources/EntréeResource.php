<?php

namespace App\Filament\Clusters\Ecriture\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Devise;
use App\Models\Entrée;
use App\Models\Article;
use App\Models\Indicateur;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Ecriture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Ecriture\Resources\EntréeResource\Pages;
use App\Filament\Clusters\Ecriture\Resources\EntréeResource\RelationManagers;
use Carbon\Carbon;

class EntréeResource extends Resource
{
    protected static ?string $model = Entrée::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-on-square-stack';

    protected static ?string $cluster = Ecriture::class;

    protected static bool $shouldRegisterNavigation = false;


    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('nature', 'entree')->where('user_id', Auth::user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Section::make('')
                        ->schema([
                            Select::make('type')
                                ->required()
                                ->placeholder('Choisir')
                                ->reactive()
                                ->options([
                                    'Solde initial' => 'Solde initial',
                                    'Consignation' => 'Consignation',
                                    'Paiement dette' => 'Paiement dette',
                                    'Manquant retrouvé' => 'Manquant retrouvé',
                                    'Paiement commission' => 'Paiement commission',
                                    'Approvisionnement' => 'Approvisionnement',
                                    'Autres' => 'Autres',
                                ]),
                            TextInput::make('auteur')
                                ->label("Client ou Libellé")
                                ->required(),

                            // TextInput::make('user_id')
                            //    dans  le model Entrée
                            // TextInput::make('nature')
                            //    dans  le model Entrée
                        ]),
                    Section::make('')
                        ->visible(fn ($get) => $get('type') === 'Paiement commission' || $get('type') === 'Approvisionnement' || $get('type') === 'Paiement dette' || $get('type') === 'Manquant retrouvé')
                        ->schema([
                            Select::make('article_id')
                                ->label('Article')
                                ->required()
                                ->options(Article::pluck('name', 'id')->toArray())
                                ->visible(fn ($get) => $get('type') === 'Paiement commission' || $get('type') === 'Approvisionnement')
                                ->placeholder('Choisir'),
                            DatePicker::make('date_ref')
                                ->label("Date réference")
                                ->visible(fn ($get) => $get('type') === 'Paiement dette' || $get('type') === 'Manquant retrouvé')
                                ->required(),
                        ])->columns(2),
                    Section::make('')
                        ->schema([
                            Select::make('devise_id')
                                ->required()
                                ->options(Devise::pluck('code', 'id')->toArray())
                                ->placeholder('Choisir'),
                            TextInput::make('montant')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ])->columns(2),
                    Section::make('')
                        ->schema([
                            Textarea::make("note")
                                ->label("Motif ou commentaire")
                                ->required(fn ($get) => $get('type') === 'Autres' || $get('type') === 'Consignation')
                                ->rows(2)
                                ->visible(fn ($get) => $get('type') === 'Autres' || $get('type') === 'Consignation'),
                        ])->hidden(fn ($get) => $get('type') !== 'Autres' && $get('type') !== 'Consignation'),
                ])
                ->columnSpan(['lg' => 2]),

                Section::make()
                ->schema([
                    Forms\Components\Placeholder::make('created_at')
                        ->label('Created at')
                        ->content(fn (Entrée $record): ?string => $record->created_at?->diffForHumans()),

                    Forms\Components\Placeholder::make('updated_at')
                        ->label('Last modified at')
                        ->content(fn (Entrée $record): ?string => $record->updated_at?->diffForHumans()),
                ])
                ->columnSpan(['lg' => 1])
                ->hidden(fn (?Entrée $record) => $record === null)
            ])->columns(3);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEntrées::route('filament.admin.ecriture'),
            'create' => Pages\CreateEntrée::route('/create'),
            'edit' => Pages\EditEntrée::route('/{record}/edit'),
        ];
    }

}
