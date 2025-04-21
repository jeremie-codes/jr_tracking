<?php

namespace App\Filament\Clusters\Ecriture\Resources;

use App\Filament\Clusters\Ecriture;
use App\Filament\Clusters\Ecriture\Resources\SortieResource\Pages;
use App\Filament\Clusters\Ecriture\Resources\SortieResource\RelationManagers;
use Filament\Forms;
use Filament\Tables;
use App\Models\Devise;
use App\Models\Sortie;
use App\Models\Article;
use Carbon\Carbon;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SortieResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square-stack';

    protected static ?string $cluster = Ecriture::class;

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('nature', 'sortie')->where('user_id', Auth::user()->id);
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
                                    'Solde final' => 'Solde final',
                                    'Cession de fond' => 'Cession de fond',
                                    'Dette' => 'Dette',
                                    'Remboursement' => 'Remboursement',
                                    'Excédent retrouvé' => 'Excédent retrouvé',
                                    'Dépenses' => 'Dépenses',
                                    'Autres' => 'Autres',
                                ]),
                            TextInput::make('auteur')
                                ->label("Client/Auteur/Libellé")
                                ->required(),
                            ]),

                        Section::make('')
                            ->visible(fn ($get) => $get('type') === 'Remboursement' || $get('type') === 'Excédent retrouvé' || $get('type') === 'Cession de fond')
                            ->schema([
                                Select::make('article_id')
                                    ->label('Article')
                                    ->required()
                                    ->options(Article::pluck('name', 'id')->toArray())
                                    ->visible(fn ($get) => $get('type') === 'Cession de fond')
                                    ->placeholder('Choisir'),
                                DatePicker::make('date_ref')
                                    ->label("Date réference")
                                    ->visible(fn ($get) => $get('type') === 'Remboursement' || $get('type') === 'Excédent retrouvé')
                                    ->required(),
                            ])->columns(2),

                        Section::make('')
                            ->schema([
                                Select::make('devise_id')
                                    ->required()
                                    ->label('Devise')
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
                                    ->label("Motif/Raison/commentaire")
                                    // ->required()
                                    ->rows(2)
                                    ->visible(fn ($get) => $get('type') === 'Autres'),
                            ])->hidden(fn ($get) => $get('type') !== 'Autres'),
                    ])->columnSpan(['lg' => 2]),

                    Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (Sortie $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Sortie $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Sortie $record) => $record === null)
                ])->columns(3);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSorties::route('filament.admin.ecriture'),
            'create' => Pages\CreateSortie::route('/create'),
            'edit' => Pages\EditSortie::route('/{record}/edit'),
        ];
    }
}
