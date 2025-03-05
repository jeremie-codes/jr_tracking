<?php

namespace App\Filament\Clusters\Ecriture\Resources;

use App\Filament\Clusters\Ecriture;
use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource\Pages;
use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource\RelationManagers;
use App\Models\PlusieurMouvement;
use Filament\Forms;
use Filament\Tables;
use App\Models\Devise;
use App\Models\Entrée;
use App\Models\Article;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Repeater;
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
use Illuminate\Support\Facades\DB;

class PlusieurMouvementResource extends Resource
{
    protected static ?string $model = PlusieurMouvement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Ecriture::class;

    protected static ?int $navigationSort = 2;

    // protected static ?string $na

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('Plusieurs_Écritures')
                ->schema([
                    Section::make('')
                    ->schema([
                        TextInput::make('user_id')
                            ->label("Id Agent")
                            ->default(auth::id())
                            ->readOnly(),
                        TextInput::make('auteur')
                            ->label("Client/Operateur/Auteur/Libellé")
                            ->required(),
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
                        Select::make('nature')
                            ->options([
                                "entree" => "Entree",
                                "sortie" => "Sortie",
                            ])
                            ->required()
                            ->placeholder('Choisir'),
                        ])->columns(2),
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
                        ])  ->hidden(fn ($get) => $get('type') !== 'Autres'),
                    ])
                    ->grid(2)
                    ->addActionLabel('Ajouter une ecriture'),
            ])
            ->columns(1);
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
                TextColumn::make('note')->limit(20),
                // TextColumn::make("date_ref"),
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
            // 'index' => Pages\ListPlusieurMouvements::route('/'),
            'index' => Pages\CreatePlusieurMouvement::route('/create'),
            'edit' => Pages\EditPlusieurMouvement::route('/{record}/edit'),
        ];
    }

    public static function beforeSave($record, $data)
    {
        DB::transaction(function () use ($record, $data) {
            // Enregistrer les entrées
            foreach ($data['entrees'] as $entree) {
                $record->entrees()->create($entree);
            }

            // Enregistrer les sorties
            foreach ($data['sorties'] as $sortie) {
                $record->sorties()->create($sortie);
            }
        });
    }
}
