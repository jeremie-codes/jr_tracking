<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Seller;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SellerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SellerResource\RelationManagers;

class SellerResource extends Resource
{
    protected static ?string $model = Seller::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $label = 'Vendeurs';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'E-commerce';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Identité')
                    ->relationship('user')
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
                        TextInput::make('telephone')
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
                                'admin' => 'Administrateur',
                                'seller' => 'Vendeur',
                                'delivery_man' => 'Livreur',
                            ])
                            ->default('seller')
                    ]),
                Section::make()
                    ->schema([
                        TextInput::make('shop_name')
                            ->label('Nom de la boutique'),
                        TextInput::make('shop_address')
                            ->label('Adresse de la boutique'),
                    ]),
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
            'index' => Pages\ListSellers::route('/'),
            'create' => Pages\CreateSeller::route('/create'),
            'edit' => Pages\EditSeller::route('/{record}/edit'),
        ];
    }
}
