<?php

namespace App\Filament\Clusters\Ecriture\Resources;

use App\Filament\Clusters\Ecriture;
use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource\Pages;
use App\Filament\Clusters\Ecriture\Resources\PlusieurMouvementResource\RelationManagers;
use App\Models\PlusieurMouvement;
use Filament\Forms;
use Filament\Tables;
use App\Models\Devise;
use App\Models\Entrée;
use App\Models\Article;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Auth;

class PlusieurMouvementResource extends Resource
{
    protected static ?string $model = PlusieurMouvement::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-up-down';

    protected static ?string $cluster = Ecriture::class;

    protected static ?int $navigationSort = 2;


    public static function getPages(): array
    {
        return [
            'index' => Pages\CreateMouvement::route('/create'),
        ];
    }


}
