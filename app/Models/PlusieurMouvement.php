<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        'id_ref',
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

            // Création de l'indicateur si c'est une dette
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

        static::updated(function ($mouvement) {
            if ($mouvement->type === 'Paiement dette' && $mouvement->isDirty('montant')) {
                DB::transaction(function () use ($mouvement) {
                    $existedIndicateur = Indicateur::where('libelle', $mouvement->auteur)
                        ->whereDate('created_at', $mouvement->created_at->toDateString())
                        ->first();

                    if ($existedIndicateur) {
                        $existedIndicateur->update([
                            'montant' => $existedIndicateur->montant - $mouvement->getOriginal('montant') + $mouvement->montant,
                        ]);
                    }
                });
            }

            if ($mouvement->type === 'Dette' && $mouvement->isDirty('montant')) {
                DB::transaction(function () use ($mouvement) {
                    $originalMontant = $mouvement->getOriginal('montant');
                    $newMontant = $mouvement->montant;
                    $difference = $newMontant - $originalMontant;

                    // Mise à jour de l’indicateur lié (filtrage plus strict possible si besoin)
                    $existedIndicateur = Indicateur::where('libelle', $mouvement->auteur)
                        ->whereDate('created_at', $mouvement->created_at->toDateString())
                        ->first();

                    if ($existedIndicateur) {
                        $existedIndicateur->update([
                            'montant' => $existedIndicateur->montant + $difference,
                        ]);
                    }
                });
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
