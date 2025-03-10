<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandeResource\Pages;
use App\Filament\Resources\CommandeResource\RelationManagers;
use App\Models\Article;
use App\Models\Commande;
use App\Models\Devise;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Split;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommandeResource extends Resource
{
    protected static ?string $model = Commande::class;

    protected static ?string $navigationGroup = 'Options & Actions';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                ->schema([
                    Section::make()
                        ->schema([
                            Select::make('user_id')
                                ->label('Destinataire')
                                ->placeholder('Choisir')
                                ->relationship('user', 'name')
                                ->required(),
                            TextInput::make('numero')
                                ->numeric()
                                ->required(),
                            TextInput::make('person_id')
                                ->label("Id Agent")
                                ->default(auth::id())
                                ->required()
                                ->readOnly(),
                        ])->columns(3),

                    Section::make()
                        ->schema([
                            Select::make('article_id')
                                ->label('Article')
                                ->placeholder('Choisir')
                                ->relationship('article', 'name')
                                ->required(),
                            TextInput::make('montant')
                                ->numeric()
                                ->required(),
                            Select::make('devise_id')
                                ->required()
                                ->relationship('devise', 'code')
                                ->placeholder('Choisir'),
                        ])->columns(3),

                    Section::make()
                        ->schema([
                            Textarea::make('note')
                                ->placeholder('(Optional)'),
                        ]),
                ])->columnSpan(['lg' => 2]),

                Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (Commande $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Commande $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Commande $record) => $record === null)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label('Déstinataire'),
                TextColumn::make('montant')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($record) {
                        return $record->montant . ' ' . $record->devise->code;
                    }),
                TextColumn::make('article.name')
                    ->searchable()
                    ->sortable()
                    ->label('Article'),
                TextColumn::make('status')
                    ->color(function (Commande $record) {
                        return $record->status === 'attente' ? 'warning' : ($record->status === 'approuvée' ? 'success' : 'danger');
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'attente' => 'heroicon-o-clock',
                        'approuvée' => 'heroicon-o-check-circle',
                        'désapprouvée' => 'heroicon-o-x-mark',
                    })
                    ->badge()
                    ->sortable(),
                TextColumn::make('person.name')
                    ->label('Initiateur'),
                TextColumn::make('created_at')
                    ->label('Date commandée'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Editer'),
                Tables\Actions\DeleteAction::make()->label('Supprimer'),
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
            'index' => Pages\ListCommandes::route('/'),
            'create' => Pages\CreateCommande::route('/create'),
            'edit' => Pages\EditCommande::route('/{record}/edit'),
        ];
    }
}
