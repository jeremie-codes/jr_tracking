<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Indicateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'devise_id',
        'montant',
        'date_ref',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function devise() {
        return $this->belongsTo(Devise::class);
    }
}
