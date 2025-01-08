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
 * @property int $seller_id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Seller $seller
 *
 * @package App\Models
 */
class Product extends Model
{
	protected $table = 'products';

	protected $casts = [
		'seller_id' => 'int',
		'category_id' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'seller_id',
		'category_id',
		'name',
		'description',
		'image',
		'price'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function seller()
	{
		return $this->belongsTo(Seller::class);
	}
}
