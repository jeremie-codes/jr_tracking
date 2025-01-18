<?php

namespace App\Filament\Clusters\Products;

use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Clusters\Products;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\Products\Pages\EditCategory;
use App\Filament\Clusters\Products\Pages\CreateCategory;
use App\Filament\Clusters\Products\Pages\ListCategories;
use App\Filament\Resources\CategoryResource\RelationManagers;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $label = 'Catégories';
    protected static ?int $navigationSort = 2;
    protected static ?string $cluster = Products::class;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Section::make()
                    // ->schema([
                    //     FileUpload::make('image')
                    //         ->directory('category-images')
                    //         ->imageEditor()
                    //         ->image()
                    // ]),
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Toggle::make('is_visible')
                            ->label('Visible au public.')
                            ->default(true),
                        MarkdownEditor::make('description')
                            ->label('Description'),
                    ])
                    ->columnSpan(['lg' => fn(?Category $record) => $record === null ? 3 : 2]),

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Créé le')
                            ->content(fn(Category $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Modifié le')
                            ->content(fn(Category $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn(?Category $record) => $record === null),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_visible')
                    ->label('Visibilité')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Date de mis à jour')
                    ->date()
                    ->sortable()
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }
}
