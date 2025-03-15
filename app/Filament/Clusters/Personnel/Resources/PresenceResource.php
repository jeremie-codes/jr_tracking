<?php

namespace App\Filament\Clusters\Personnel\Resources;

use App\Filament\Clusters\Personnel;
use App\Filament\Clusters\Personnel\Resources\PresenceResource\Pages;
use App\Filament\Clusters\Personnel\Resources\PresenceResource\RelationManagers;
use App\Models\Presence;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use Filament\Tables\Columns\ToggleColumn;

class PresenceResource extends Resource
{
    protected static ?string $model = Presence::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = Personnel::class;

    protected static ?string $label = 'Présences';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Split::make('lg')
                // ->columnSpan(['lg' => 1])
                // ->schema([
                    Section::make('Personnel')
                        ->schema([
                            Select::make('user_id')
                                ->label('Utilisateur')
                                ->relationship('user', 'name')
                                ->required(),
                            Forms\Components\Toggle::make('retard')
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if ($state) {
                                        $set('absent', false);
                                    }
                                }),
                            Forms\Components\Toggle::make('absent')
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if ($state) {
                                        $set('retard', false);
                                    }
                                }),
                        ])->collapsible(),
                    Section::make('Détail')
                        ->schema([
                            TimePicker::make('arrived')
                                ->label('Heure d\'arrivée')
                                ->required(),
                            TimePicker::make('departed')
                                ->label('Heure de départ'),
                            DatePicker::make('created_at')
                                ->label('Date')
                                ->default(now()),

                        ]),
                // ])
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Agent'),
                IconColumn::make('retard')->icon(function ($record) {
                   return $record->retard ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle';
                })
                ->color(function ($record) {
                        return $record->retard ? 'success' : 'danger';
                }),
                IconColumn::make('absent')->icon(function ($record) {
                   return $record->absent ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle';
                })
                ->color(function ($record) {
                        return $record->absent ? 'success' : 'danger';
                }),
                TextColumn::make('arrived')->label('Arrivée'),
                TextColumn::make('departed')->label('Départ'),
                TextColumn::make('created_at')->label('Date')->limit(10),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier'),
                Tables\Actions\DeleteAction::make()->label(''),
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
            'index' => Pages\ListPresences::route('/'),
            'create' => Pages\CreatePresence::route('/create'),
            'edit' => Pages\EditPresence::route('/{record}/edit'),
        ];
    }
}
