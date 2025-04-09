<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApprovisionnerAgentResource\Pages;
use App\Filament\Resources\ApprovisionnerAgentResource\RelationManagers;
use App\Models\Article;
use App\Models\Approvision;
use App\Models\Devise;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ApprovisionnerAgentResource extends Resource
{
    protected static ?string $model = Approvision::class;

    protected static ?string $label = "Approvisionner Caisse";

    protected static ?string $navigationGroup = 'Options & Actions';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {

        if (Auth::user()->role === 'Admin') {
            return static::getModel()::query()->where('type','approvisionnement')->orderBy('id', 'desc');
        }

        return static::getModel()::query()->where('type','approvisionnement')->where(function ($query) {
            $query->where('user_id', Auth::user()->id)->orWhere('person_id', Auth::user()->id);
        })->orderBy('id', 'desc');
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

                        //person_id est rempli automatiquement à partir du hook boot dans le Model Approvision

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
                            ->content(fn (Approvision $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Approvision $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?Approvision $record) => $record === null)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Aucun approvisionnement initié à cette date !')
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
                TextColumn::make('type')
                    ->label('Type')->limit(19),
                TextColumn::make('status')
                    ->color(function (Approvision $record) {
                        return $record->status === 'attente' ? 'warning' : ($record->status === 'approuvée' ? 'success' : 'danger');
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'attente' => 'heroicon-o-clock',
                        'approuvée' => 'heroicon-o-check-circle',
                        'annulée' => 'heroicon-o-x-mark',
                    })
                    ->badge()
                    ->sortable(),
                TextColumn::make('person_id')
                    ->formatStateUsing(function (Approvision $record) {
                        return $record->person_id === Auth::user()->id ? 'Moi-mème' : $record->person->name;
                    })
                    ->label('Initiateur'),
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
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
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
                // Tables\Actions\DeleteAction::make()->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canAccess(): bool
    {
        return Auth::user()->role !== 'C-abonnée' && Auth::user()->role !== 'C-agent';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApprovisionnerAgents::route('/'),
            'create' => Pages\CreateApprovisionnerAgent::route('/create'),
            'edit' => Pages\EditApprovisionnerAgent::route('/{record}/edit'),
        ];
    }
}
