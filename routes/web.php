<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Widgets\convertisseur;
use App\Http\Controllers\CommandeController;

Route::post('/convertir', [convertisseur::class, 'convertir'])->name('convertir');
Route::get('/commandes/approuver/', [CommandeController::class, 'approuver'])->name('commandes.approuver');
