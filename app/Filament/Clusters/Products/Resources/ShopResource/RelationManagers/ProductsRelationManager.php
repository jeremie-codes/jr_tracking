<?php

namespace App\Filament\Clusters\Products\Resources\ShopResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';
    protected static ?string $title = 'Les produits de la boutique';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        FileUpload::make('image')
                            ->required()
                    ]),
                Section::make()
                    ->schema([
                        Select::make('category_id')
                            ->label('Catégorie')
                            ->required()
                            ->relationship('category', 'name'),
                        Select::make('available')
                            ->label('Disponible')
                            ->options([
                                true => 'Actif',
                                false => 'Inactif',
                            ])
                            ->required(),
                    ]),
                Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->autofocus()
                            ->required()
                            ->debounce()
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                        Forms\Components\TextInput::make('slug')
                            ->readOnly()
                            ->required(),
                    ]),
                Section::make()
                    ->schema([
                        TextInput::make('price')
                            ->required(),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('posts')
                            ->columnSpan(2),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('image')->label('Image'),
                TextColumn::make('name')->label('Nom du produit')->searchable()->sortable(),
                TextColumn::make('shop.user.name')->label('Utilisateur')->sortable(),
                TextColumn::make('category.name')->label('Catégorie')->sortable(),
                TextColumn::make('price')->label('Prix')->sortable(),
                IconColumn::make('available')->label('Disponible')->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
