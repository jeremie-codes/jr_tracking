<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Widgets\convertisseur;


Route::post('/convertir', [convertisseur::class, 'convertir'])->name('convertir');
