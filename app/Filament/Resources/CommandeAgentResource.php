<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandeAgentResource\Pages;
use App\Filament\Resources\CommandeAgentResource\RelationManagers;
use App\Models\Depot;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Pages\Page;
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

class CommandeAgentResource extends Resource
{
    protected static ?string $model = Depot::class;
    protected static ?string $label = "Commandes";

    protected static ?string $navigationGroup = 'Options & Actions';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->where('see_id', Auth::id())->where('status','attente')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::query()->where('see_id', Auth::id())->where('status','attente')->count() > 0 ? 'danger' : 'primary';
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()
            ->where('type', 'depot')
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
                                ->label('Opérateur')
                                ->disabled(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord)
                                ->placeholder('Choisir')
                                ->relationship('user', 'name')
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
                                ->visible(fn ($get) => strtolower(optional(Article::find($get('article_id')))->name) === 'autres'),
                        ])->columns(2),

                        //person_id est rempli automatiquement à partir du hook boot dans le Model Commande

                    Section::make()
                        ->schema([
                            TextInput::make('agent_name')
                                ->label('Nom de l\'agent')
                                ->required(),
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
                        ])->columns(2),

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
                            ->content(fn (Depot $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Depot $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Depot $record) => $record === null)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Aucune commande trouvée pour cette date !')
            ->columns([
                TextColumn::make('agent_name')
                    ->label('Nom AG')
                    ->searchable()
                    ->sortable()
                    ->limit(12),
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
                    ->color(function (Depot $record) {
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
                    ->formatStateUsing(function (Depot $record) {
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
                Tables\Actions\EditAction::make()->label('Modif.'),
                Tables\Actions\DeleteAction::make()->label('Supp.'),
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


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommandeAgents::route('/'),
            'create' => Pages\CreateCommandeAgent::route('/create'),
            'edit' => Pages\EditCommandeAgent::route('/{record}/edit'),
        ];
    }
}
