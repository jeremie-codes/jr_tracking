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

class EntréeResource extends Resource
{
    protected static ?string $model = Entrée::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Ecriture::class;

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
                                    'Consignation' => 'Consignation',
                                    'Paiement dette' => 'Paiement dette',
                                    'Manquant retrouvé' => 'Manquant retrouvé',
                                    'Paiement commission' => 'Paiement commission',
                                    'Approvisionnement' => 'Approvisionnement',
                                    'Autres' => 'Autres',
                                ]),
                            TextInput::make('auteur')
                                ->label("Client/Operateur/Auteur/Libellé")
                                ->required(),

                            // TextInput::make('user_id')
                            //    dans  le model Entrée
                            // TextInput::make('nature')
                            //    dans  le model Entrée
                        ]),
                    Section::make('Détail')
                        ->schema([
                            TextInput::make('montant')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            Select::make('devise_id')
                                ->required()
                                ->options(Devise::pluck('code', 'id')->toArray())
                                ->placeholder('Choisir'),
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
                            Textarea::make("note")
                                ->label("Motif/Raison/commentaire")
                                ->rows(2)
                                ->visible(fn ($get) => $get('type') === 'Autres'),
                        ])->hidden(fn ($get) => $get('type') !== 'Autres'),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->sortable()
                    ->limit(10)
                    ->searchable(),
                TextColumn::make('auteur')
                    ->sortable()
                    ->label("Oper/Cli/Aut")
                    ->searchable(),
                TextColumn::make("article.name")->label("Article"),
                TextColumn::make("montant")
                ->label("Montant")
                ->formatStateUsing(function ($record) {
                    return $record->montant . ' ' . $record->devise->code;
                }),
                TextColumn::make('user.name')->label("Personnel"),
                // TextColumn::make('note')->limit(20),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label("Modifier"),
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
