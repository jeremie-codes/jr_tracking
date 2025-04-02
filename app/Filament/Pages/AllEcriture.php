<?php

namespace App\Filament\Pages;

use App\Models\PlusieurMouvement;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Clusters\Ecriture\Resources\SortieResource;
use App\Filament\Clusters\Ecriture\Resources\EntréeResource;
use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;

class AllEcriture extends Page implements HasTable

{
    protected static string $view = 'filament.pages.all-ecriture';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Options & Actions';
    protected static ?string $title = 'Ecritures';

    protected static ?int $navigationSort = 0;

    use InteractsWithTable;

    public $activeTab = 'tab1';

    public function setActiveTab($activeTab)
    {
        $this->activeTab = $activeTab;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function (Builder $query) {
                return PlusieurMouvement::query() // Utilisez le modèle ici
                    ->when($this->activeTab === 'tab1', fn ($query) => $query->where('nature', 'entree')->where('user_id', Auth::user()->id))
                    ->when($this->activeTab === 'tab2', fn ($query) => $query->where('nature', 'sortie')->where('user_id', Auth::user()->id));
            })
            ->columns([
                TextColumn::make('type')
                    ->sortable()
                    ->label('Type')
                    ->searchable(),
                TextColumn::make('auteur')
                    ->sortable()
                    ->label('Auteur')
                    ->searchable(),
                TextColumn::make('article.name')
                    ->label('Article'),
                TextColumn::make('montant')
                    ->label('Montant')
                    ->formatStateUsing(fn ($record) => $record->montant . ' ' . $record->devise->code),
                TextColumn::make('user.name')
                    ->formatStateUsing(function (PlusieurMouvement $record) {
                        return $record->user_id === Auth::user()->id ? 'Moi-mème' : $record->user->name;
                    })
                    ->hidden(Auth::user()->role !== "Admin")
                    ->label('Personnel'),
                TextColumn::make('created_at')
                    ->date()
                    ->label('Date'),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('ParDate')
                            ->default(now()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['ParDate'] ?? null,
                            fn (Builder $query, $date) => $query->whereDate('created_at', $date)
                        );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['ParDate'] ?? null) {
                            $indicators['ParDate'] = 'Filtré par ' . Carbon::parse($data['ParDate'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Modifier')
                    ->url(fn (PlusieurMouvement $record): string => $record->nature === 'sortie' ? SortieResource::getUrl('edit', ['record' => $record]) : EntréeResource::getUrl('edit', ['record' => $record])),
                ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public function getCreateSortiesPage()
    {
        return redirect(SortieResource::getUrl('create'));
    }

    public function getCreateEntréesPage()
    {
        return redirect(EntréeResource::getUrl('create'));
    }

    public function getCreatePlusieursMouvementsPage()
    {
        return redirect(PlusieurMouvementResource::getUrl('index'));
    }

}
