<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class PlusieurMouvement extends Model
{
    use HasFactory;

    protected $table = 'ecritures';

    protected $fillable = [
        'user_id',
        'auteur',
        'nature',
        'type',
        'montant',
        'devise_id',
        'article_id',
        'date_ref',
        'note',
    ];


    protected static function boot()
    {
        parent::boot();

        // Définir user_id automatiquement lors de la création si non défini
        static::creating(function (PlusieurMouvement $mouvement) {
            if (is_null($mouvement->user_id)) {
                $mouvement->user_id = Auth::id();
            }
        });
    }


    protected static function booted(): void
    {
        static::created(function ($mouvement) {
            if ($mouvement->type === 'Dette') {
                Indicateur::create([
                    'montant' => $mouvement->montant,
                    'libelle' => $mouvement->auteur,
                    'type' => 'dette',
                    'date_ref' => $mouvement->created_at,
                    'user_id' => $mouvement->user_id,
                    'devise_id' => $mouvement->devise_id,
                ]);
            }

            if ($mouvement->type === 'Paiement dette') {
                Indicateur::create([
                    'montant' => $mouvement->montant,
                    'libelle' => $mouvement->auteur,
                    'type' => 'paiement',
                    'date_ref' => $mouvement->date_ref,
                    'user_id' => $mouvement->user_id,
                    'devise_id' => $mouvement->devise_id,
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
