<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Models\Devise;

class Retrait extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'commandes';
    
    protected $fillable = [
        'user_id',
        'see_id',
        'person_id',
        'numero',
        'article_id',
        'montant',
        'devise_id',
        'status',
        'type',
        'note',
        'libelle',
        'agent_name',
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

    protected static function boot()
    {
        parent::boot();

        // Définir operated_id automatiquement lors de la création
        static::creating(function (Retrait $commande) {
            $commande->person_id = Auth::id();
            $commande->type = 'retrait';
            $commande->see_id = $commande->user_id;
        });

        static::updating(function (Retrait $commande) {
            if ($commande->person_id == Auth::id()) {
                $commande->see_id = $commande->user_id;
            }
            else {
                $commande->see_id = $commande->person_id;
            }
        });
    }

}
