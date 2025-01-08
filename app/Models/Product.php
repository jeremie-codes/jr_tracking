<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * 
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $image
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property User $user
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'user_id' => 'int',
		'category_id' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'user_id',
		'category_id',
		'name',
		'slug',
		'description',
		'image',
		'price'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
