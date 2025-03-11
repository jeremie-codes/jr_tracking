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
                                TextInput::make('auteur')
                                    ->label("Client/Operateur/Auteur/Libellé")
                                    ->required(),
                                Select::make('nature')
                                    ->options([
                                        "entree" => "Entree",
                                        "sortie" => "Sortie",
                                    ])
                                    ->required()
                                    ->reactive()
                                    ->placeholder('Choisir'),
                                Select::make('type')
                                    ->required()
                                    ->placeholder('Choisir')
                                    ->options(function (callable $get) {
                                        $nature = $get('nature');
                                        if ($nature === 'entree') {
                                            return [
                                                'Consignation' => 'Consignation',
                                                'Paiement dette' => 'Paiement dette',
                                                'Manquant retrouvé' => 'Manquant retrouvé',
                                                'Paiement commission' => 'Paiement commission',
                                                'Approvisionnement' => 'Approvisionnement',
                                                'Autres' => 'Autres',
                                            ];
                                        } else {
                                            return [
                                                'Cession de fond' => 'Cession de fond',
                                                'Dette' => 'Dette',
                                                'Remboursement' => 'Remboursement',
                                                'Excédent retrouvé' => 'Excédent retrouvé',
                                                'Dépenses' => 'Dépenses',
                                                'Autres' => 'Autres',
                                            ];
                                        }
                                    }),
                            ]),
                        Section::make('Détail')
                            ->schema([
                                TextInput::make('montant')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                                Select::make('devise_id')
                                    ->label('Devise')
                                    ->required()
                                    ->options(Devise::pluck('code', 'id')->toArray())
                                    ->placeholder('Choisir'),
                                Select::make('article_id')
                                    ->label('Article')
                                    ->required()
                                    ->options(Article::pluck('name', 'id')->toArray())
                                    ->visible(fn ($get) => $get('type') === 'Paiement commission' || $get('type') === 'Approvisionnement' || $get('type') === 'Cession de fond')
                                    ->placeholder('Choisir'),
                                DatePicker::make('date_ref')
                                    ->label("Date réference")
                                    ->visible(fn ($get) => $get('type') === 'Paiement dette' || $get('type') === 'Manquant retrouvé' || $get('type') === 'Remboursement' || $get('type') === 'Excédent retrouvé')
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
                    ->grid(2)
                    ->defaultItems(2)
                    ->addActionLabel('Ajouter une ecriture'),
            ])
            ->columns(1);
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

}
