<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Widgets\convertisseur;
use App\Http\Controllers\CommandeController;
use App\Livewire\Message;

Route::post('/convertir', [convertisseur::class, 'convertir'])->name('convertir');
Route::post('/commandes/approuver/', [CommandeController::class, 'approuver'])->name('commandes.approuver');
Route::post('/commandes/modifier/', [CommandeController::class, 'modifier'])->name('commandes.modifier');
Route::post('/commandes/desapprouver/', [CommandeController::class, 'desapprouver'])->name('commandes.desapprouver');
