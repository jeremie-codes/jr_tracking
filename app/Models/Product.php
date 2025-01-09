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
 * @property int $shop_id
 * @property int $category_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $image
 * @property bool $available
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Shop $shop
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'shop_id' => 'int',
		'category_id' => 'int',
		'available' => 'bool',
		'price' => 'float'
	];

	protected $fillable = [
		'shop_id',
		'category_id',
		'name',
		'slug',
		'description',
		'image',
		'available',
		'price'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function shop()
	{
		return $this->belongsTo(Shop::class);
	}
}
