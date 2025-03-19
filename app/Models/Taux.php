<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Taux extends Model
{
    use HasFactory;

    protected $table = "taux";

    protected $fillable = [
        'devise_source_id',
        'devise_cible_id',
        'taux_vente',
        'taux_achat',
    ];

    public function devise_source() {
        return $this->belongsTo(Devise::class, 'devise_source_id');
    }

    public function devise_cible() {
        return $this->belongsTo(Devise::class, 'devise_cible_id');
    }

}
