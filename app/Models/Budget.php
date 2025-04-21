<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'rep_init',
        'reel_final',
        'rep_final'
    ];
}
