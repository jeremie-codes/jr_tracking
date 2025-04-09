<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Widgets\convertisseur;
use App\Http\Controllers\CommandeController;

Route::post('/convertir', [convertisseur::class, 'convertir'])->name('convertir');
Route::post('/commandes/approuver/', [CommandeController::class, 'approuver'])->name('commandes.approuver');
Route::post('/commandes/modifier/', [CommandeController::class, 'modifier'])->name('commandes.modifier');
Route::post('/commandes/desapprouver/', [CommandeController::class, 'desapprouver'])->name('commandes.desapprouver');

Route::get('/ecriture/sorties', function () {
    return redirect('/all-ecriture');
});

Route::get('/ecriture/entrees', function () {
    return redirect('/all-ecriture');
});

Route::get('/ecriture/plusieur-mouvements/', function () {
    return redirect('/all-ecriture');
});
