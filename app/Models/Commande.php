<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\CommandeObserver;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\CommandeResource;
use App\Models\Devise;
use Filament\Notifications\Actions\Action;
use Livewire\Livewire;

#[ObservedBy([CommandeObserver::class])]
class Commande extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'person_id',
        'numero',
        'article_id',
        'montant',
        'devise_id',
        'status',
        'type',
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

    protected static function boot()
    {
        parent::boot();

        // Définir operated_id automatiquement lors de la création
        static::creating(function (Commande $commande) {
            $commande->person_id = Auth::id();
        });
    }

}
