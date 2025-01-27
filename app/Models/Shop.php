<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Shop
 * 
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property bool $status
 * @property string|null $image
 * 
 * @property User $user
 * @property Collection|Product[] $products
 *
 * @package App\Models
 */
class Shop extends Model
{
	protected $table = 'shops';

	protected $casts = [
		'user_id' => 'int',
		'status' => 'bool'
	];

	protected $fillable = [
		'name',
		'user_id',
		'status',
		'image'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
