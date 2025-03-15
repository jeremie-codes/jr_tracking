<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Widgets\convertisseur;
use App\Http\Controllers\CommandeController;
use App\Livewire\Message;

Route::post('/convertir', [convertisseur::class, 'convertir'])->name('convertir');
Route::get('/commandes/approuver/', [CommandeController::class, 'approuver'])->name('commandes.approuver');
Route::get('/commandes/modifier/', [CommandeController::class, 'modifier'])->name('commandes.modifier');
Route::get('/commandes/desapprouver/', [CommandeController::class, 'desapprouver'])->name('commandes.desapprouver');
