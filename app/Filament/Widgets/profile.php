<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Commande;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class profile extends Widget
{
    protected static ?int $sort = 0;
    protected static string $view = 'filament.widgets.profile';

    public function __construct()
    {
        // Récupérer les notifications pour l'utilisateur connecté
        $commandeCount = Commande::where('user_id', Auth::id())
        ->where('see_id', Auth::id())->where('status', 'attente')
        ->orderBy('created_at', 'desc')->get()->count();

        if ($commandeCount > 0) {

            Notification::make()
                ->title('Vous avez des notifications en attente')
                ->body('Consultez pour approuver ou annuler.')
                ->warning()
                ->color('warning')
                ->persistent()
                ->send();
        }
    }
}
