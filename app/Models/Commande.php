<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'person_id',
        'numero',
        'article_id',
        'montant',
        'devise_id',
        'status',
        'note',
    ];

    public function person() {
        return $this->belongsTo(User::class, 'person_id');
    }

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
