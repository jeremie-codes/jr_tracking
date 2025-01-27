<?php

namespace App\Repository\Product;

use App\Contracts\BaseOpContract;

interface ProductContract extends BaseOpContract
{
    public function toGetProductByCategory($category);
    public function toGetProductBySeller($sellerId);
    public function toGetProductByShop($shopId);
    public function toGetLatest($n);
    public function toGetProductByPriceRange($priceRange);
    public function getFilteredProducts($categoryId = null, $priceRange = null, $sort = null, $shopId = null, $n);
    public function latestProducts($n);
}