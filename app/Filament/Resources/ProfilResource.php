<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilResource\Pages;
use App\Filament\Resources\ProfilResource\RelationManagers;
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

class ProfilResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Profil';
    protected static ?string $pluralLabel = 'Profil';
    protected static ?string $navigationGroup = 'Configurations';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profil')
                    ->schema([
                        FileUpload::make('avatar')
                            ->imageEditor()
                            ->image()

                    ]),
                Section::make('Identité')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom complet')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->maxLength(255),
                    ]),
                    Section::make()
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
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\RedirectToEdit::route('/'),
            'edit' => Pages\EditProfil::route('/{record}/edit'),
        ];
    }
}
