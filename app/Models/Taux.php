<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taux extends Model
{
    use HasFactory;

    protected $table = "taux";

    protected $fillable = [
        'devise_id',
        'achat',
        'vente',
    ];
}
