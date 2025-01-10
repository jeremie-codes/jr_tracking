<?php

namespace App\Repository\Product;

use App\Models\Product;

class ProductRepo implements ProductContract
{

    public function toGetProductByCategory($categoryId)
    {
        $product = Product::where('category_id', $categoryId)->get();
        return $product;
    }

    public function toGetProductBySeller($sellerId)
    {
        return Product::whereHas('shop', function ($query) use ($sellerId) {
            $query->whereHas('user', function ($query) use ($sellerId) {
                $query->where('id', $sellerId);
            });
        })
            ->with('shop')
            ->get();
    }

    public function toGetProductByShop($shopId)
    {
        return Product::where('shop_id', $shopId)->get();
    }

    /**
     *
     * @param array $inputs
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toAdd(array $inputs): \Illuminate\Database\Eloquent\Model
    {
        $product = Product::create($inputs);
        return $product;
    }

    /**
     *
     * @param array $inputs
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toUpdate(array $inputs, $id): \Illuminate\Database\Eloquent\Model
    {
        $product = $this->toGetById($id);
        foreach ($inputs as $property => $value)
            $product->$property = $value;
        $product->update();

        return $product;
    }

    /**
     *
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toDelete($id): \Illuminate\Database\Eloquent\Model
    {
        $product = $this->toGetById($id);
        $product->delete();
        return $product;
    }

    /**
     *
     * @param mixed $n
     */
    public function toGetAll($n = 50)
    {
        $product = Product::with('product_type', 'therapeutic_category')
            ->paginate($n);
        return $product;
    }

    /**
     *
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toGetById($id): \Illuminate\Database\Eloquent\Model
    {
        return Product::findOrFail($id);
    }
}
