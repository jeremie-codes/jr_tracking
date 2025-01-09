<?php

namespace App\Filament\Clusters\Customer\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Seller;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Customer;
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
use App\Filament\Resources\SellerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SellerResource\RelationManagers;
use App\Filament\Clusters\Customer\Resources\SellerResource\Pages\EditSeller;
use App\Filament\Clusters\Customer\Resources\SellerResource\Pages\ListSellers;
use App\Filament\Clusters\Customer\Resources\SellerResource\Pages\CreateSeller;

class SellerResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $label = 'Vendeurs';
    protected static ?string $cluster = Customer::class;

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('role', 'seller')->with('shop');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Avatar')
                    ->schema([
                        FileUpload::make('avatar')
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
                        TextInput::make('phone_number')
                            ->required()
                            ->maxLength(20)
                            ->label('Téléphone'),
                        TextInput::make('address')
                            ->required()
                            ->maxLength(255)
                            ->label('Adresse'),
                        Select::make('role')
                            ->visible(false)
                            ->options([
                                'customer' => 'Client',
                                'seller' => 'Vendeur',
                                'admin' => 'Administrateur',
                            ])
                            ->default('seller'),
                        DatePicker::make('date_of_birth'),
                        Select::make('gender')
                            ->options([
                                'male' => 'Homme',
                                'female' => 'Femme',
                            ]),
                        TextInput::make('phone_number')
                    ]),
                Section::make()
                    ->schema([
                        TextInput::make('shop.name')
                            ->required()
                            ->label('Nom de la boutique'),
                    ]),
                Section::make()
                    ->schema([
                        TextInput::make('password')
                            ->password()
                            ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
                            ->minLength(8)
                            ->same('password_confirmation')
                            ->dehydrated(fn($state) => filled($state))
                            ->dehydrateStateUsing(fn($state) => Hash::make($state)),
                        TextInput::make('password_confirmation')
                            ->label('Password confirmation')
                            ->password()
                            ->required(fn(Page $livewire): bool => $livewire instanceof CreateRecord)
                            ->minLength(8)
                            ->dehydrated(false)
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Avatar')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nom complet')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone_number')
                    ->label('Téléphone')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Adresse')
                    ->limit(20)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('shop.name')
                    ->label('Nom de la boutique')
                    ->limit(20)
                    ->searchable()
                    ->sortable(),
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
            'index' => ListSellers::route('/'),
            'create' => CreateSeller::route('/create'),
            'edit' => EditSeller::route('/{record}/edit'),
        ];
    }
}
