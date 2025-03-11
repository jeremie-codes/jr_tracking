<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

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


    protected static function boot()
    {
        parent::boot();

        // Définir operated_id automatiquement lors de la création
        static::creating(function (Sortie $sortie) {
            $sortie->user_id = Auth::id();
            $sortie->nature = 'sortie';
        });
    }


    protected static function booted(): void
    {
        static::created(function ($sortie) {
            if ($sortie->type === 'Dette') {
                Indicateur::create([
                    'montant' => $sortie->montant,
                    'type' => 'dette',
                    'date_ref' => $sortie->created_at,
                    'user_id' => $sortie->user_id,
                    'devise_id' => $sortie->devise_id,
                ]);
            }
        });
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
