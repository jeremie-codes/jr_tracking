<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Entrée extends Model
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
        static::creating(function (Entrée $entrée) {
            $entrée->user_id = Auth::id();
            $entrée->nature = 'entree';
        });
    }

    protected static function booted(): void
    {
        static::created(function ($entrée) {
            if ($entrée->type === 'Paiement dette') {
                Indicateur::create([
                    'montant' => $entrée->montant,
                    'type' => 'paiement',
                    'libelle' => $entrée->auteur,
                    'date_ref' => $entrée->date_ref,
                    'user_id' => $entrée->user_id,
                    'devise_id' => $entrée->devise_id,
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
