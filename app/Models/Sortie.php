<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sortie extends Model
{
    use HasFactory;

    protected $table = 'ecritures';

    protected $fillable = [
        'user_id',
        'nature',
        'type',
        'montant',
        'devise_id',
        'auteur',
        'article_id',
        'motif',
        'note',
        'date_ref',
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function article() {
        return $this->belongsTo(Article::class);
    }

    public function devise() {
        return $this->belongsTo(Devise::class);
    }

}
