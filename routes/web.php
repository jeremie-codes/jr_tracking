<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Widgets\convertisseur;
use App\Http\Controllers\CommandeController;

Route::post('/convertir', [convertisseur::class, 'convertir'])->name('convertir');
Route::post('/commandes/{commande}/approuver', [CommandeController::class, 'approuver'])->name('commandes.approuver');
