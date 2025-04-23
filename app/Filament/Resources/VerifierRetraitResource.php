<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VerifierRetraitResource\Pages;
use App\Filament\Resources\VerifierRetraitResource\RelationManagers;
use App\Models\Commande;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
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
use Illuminate\Support\Carbon;

class VerifierRetraitResource extends Resource
{
    protected static ?string $model = Commande::class;

    protected static ?string $label = "Vérifier retrait";

    protected static ?string $navigationGroup = 'Options & Actions';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()
            ->where('type', 'retrait')
            ->where(function ($query) {
                $query->where('user_id', Auth::user()->id)
                    ->orWhere('person_id', Auth::user()->id);
            })
            ->orderBy('id', 'desc');
    }


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
                                ->disabled(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord)
                                ->placeholder('Choisir')
                                ->options(function () {
                                    // Vérifiez le rôle de l'utilisateur connecté
                                    if (Auth::user()->role === 'C-abonné' || Auth::user()->role === 'C-agent') {
                                        // Retournez uniquement les utilisateurs ayant le rôle 'Operateur-e-money'
                                        return \App\Models\User::where('role', 'Operateur-e-money')->pluck('name', 'id');
                                    }

                                    // Par défaut, retournez tous les utilisateurs
                                    return \App\Models\User::pluck('name', 'id');
                                })
                                ->required(),
                            Select::make('article_id')
                                ->label('Article')
                                ->placeholder('Choisir')
                                ->reactive()
                                ->relationship('article', 'name')
                                ->required(),
                            TextInput::make('libelle')
                                ->label('Précisez l\'article')
                                ->required()
                                ->columnSpan(2)
                                ->visible(fn ($get) => optional(Article::find($get('article_id')))->name === 'Autres'),
                        ])->columns(2),

                        //person_id est rempli automatiquement à partir du hook boot dans le Model Commande

                    Section::make()
                        ->schema([
                            TextInput::make('numero')
                                ->numeric()
                                ->required(),
                            Select::make('devise_id')
                                ->required()
                                ->relationship('devise', 'code')
                                ->placeholder('Choisir'),
                            TextInput::make('montant')
                                ->numeric()
                                ->required(),
                        ])->columns(3),

                    Section::make()
                        ->schema([
                            Textarea::make('note')
                                ->label('Commentaire')
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
            ->emptyStateHeading('Aucun retrait trouvée pour cette date !')
            ->columns([
                TextColumn::make('numero')
                    ->label('Téléphone')
                    ->searchable()
                    ->sortable(),
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
                TextColumn::make('type')
                    ->label('Type')->limit(19),
                TextColumn::make('status')
                    ->color(function (Commande $record) {
                        return $record->status === 'attente' ? 'warning' : ($record->status === 'approuvée' ? 'success' : 'danger');
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'attente' => 'heroicon-o-clock',
                        'approuvée' => 'heroicon-o-check-circle',
                        'annulée' => 'heroicon-o-x-mark',
                    })
                    ->badge()
                    ->sortable(),
                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function (Commande $record) {
                        return $record->user_id === Auth::user()->id ? 'Moi-mème' : $record->user->name;
                    })
                    ->label('opérateur'),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('ParDate')
                            ->default(now()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['ParDate'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['ParDate'] ?? null) {
                            $indicators['ParDate'] = 'Order from ' . Carbon::parse($data['ParDate'])->toFormattedDateString();
                        }

                        return $indicators;
                    })
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

    public static function canAccess(): bool
    {
        return Auth::user()->role === 'C-agent';
    }

    // public static function canCreate(): bool
    // {
    //     return false;
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVerifierRetraits::route('/'),
            'create' => Pages\CreateVerifierRetrait::route('/create'),
            'edit' => Pages\EditVerifierRetrait::route('/{record}/edit'),
        ];
    }
}
