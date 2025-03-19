<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    protected $table = 'callbacks';

    protected $fillable = [
        'currency',
        'phone',
        'total_price',
        'channel',
        'orderNumber',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
