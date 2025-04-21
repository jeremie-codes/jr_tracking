<?php

namespace App\Filament\Clusters\Personnel\Resources;

use App\Filament\Clusters\Personnel;
use App\Filament\Clusters\Personnel\Resources\AgentResource\Pages;
use App\Filament\Clusters\Personnel\Resources\AgentResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Article; // Assure-toi d'importer ton modèle Article

class AgentResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $pluralLabel = 'Agents';
    protected static ?string $pluralModelLabel = 'Agents';
    protected static ?string $cluster = Personnel::class;

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('id', '!=', Auth::user()->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profil')
                    ->schema([
                        FileUpload::make('avatar')
                            ->label('Image de profil')
                            ->imageEditor()
                            ->image()

                    ]),
                Section::make('Identité')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom complet')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->maxLength(255),
                        Select::make('role')
                            ->options([
                                'C-abonné'=> 'C-abonné',
                                'C-agent'=> 'C-agent',
                                'Operateur-e-money'=> 'Operateur-e-money',
                                'T-Simple'=> 'T-Simple',
                                'T-operateur'=> 'T-operateur',
                                'T-controlleur'=> 'T-controlleur',
                                'Admin'=> 'Administrateur',
                            ])
                            ->required(),
                        Select::make('tasks')->label('Tâches')
                            ->searchable(false)
                            ->required()
                            ->options(function () {
                                return Article::where('name', '!=', 'Autres')
                                    ->pluck('name', 'id'); // Assurez-vous d'utiliser 'id' comme clé
                            })
                            ->multiple()
                    ]),
                    Section::make(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord ? 'Changer le Mot de passe': '')
                        ->schema([
                            TextInput::make('password')
                                ->password()
                                // ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
                                ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord) // Rend obligatoire seulement lors de la création
                                ->minLength(8)
                                ->same('password_confirmation')
                                ->dehydrated(fn($state) => filled($state))
                                ->dehydrateStateUsing(fn($state) => Hash::make($state)),
                            TextInput::make('password_confirmation')
                                ->label('Password confirmation')
                                ->password()
                                // ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
                                ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord) // Rend obligatoire seulement lors de la création
                                ->minLength(8)
                                ->dehydrated(false)
                        ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->defaultSort('id', 'desc')
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Profil')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nom complet')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tasks')
                    ->label('Tâches')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
                // Tables\Actions\DeleteAction::make()->label('Supprimer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Tout Supprimer'),
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
            'index' => Pages\ListAgents::route('/'),
            'create' => Pages\CreateAgent::route('/create'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
        ];
    }
}
