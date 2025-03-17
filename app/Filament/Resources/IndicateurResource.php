<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndicateurResource\Pages;
use App\Filament\Resources\IndicateurResource\RelationManagers;
use App\Models\Indicateur;
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
use Illuminate\Support\Carbon;

class IndicateurResource extends Resource
{
    protected static ?string $model = Indicateur::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-up';
    protected static ?string $navigationGroup = 'Rapports';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Aucun indicateur trouvé !')
            ->columns([
                TextColumn::make('type')
                    ->sortable()
                    ->limit(10)
                    ->searchable(),
                TextColumn::make('libelle')
                    ->label('Auteur/Bénéficiaire')
                    ->searchable(),
                TextColumn::make("montant")
                    ->label("Montant")
                    ->formatStateUsing(function ($record) {
                        return $record->montant . ' ' . $record->devise->code;
                    }),
                TextColumn::make('user.name')->label("Agent"),
                TextColumn::make('date_ref')->label("Date reference")->date(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('Date_debut')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('Date_fin')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['Date_debut'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['Date_fin'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['Date_debut'] ?? null) {
                            $indicators['Date_debut'] = 'Order from ' . Carbon::parse($data['Date_debut'])->toFormattedDateString();
                        }
                        if ($data['Date_fin'] ?? null) {
                            $indicators['Date_fin'] = 'Order until ' . Carbon::parse($data['Date_fin'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
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

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndicateurs::route('/'),
            'create' => Pages\CreateIndicateur::route('/create'),
            'edit' => Pages\EditIndicateur::route('/{record}/edit'),
        ];
    }
}
