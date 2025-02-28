<?php

namespace App\Repository\Product;

use App\Contracts\BaseOpContract;

interface ProductContract extends BaseOpContract
{
    public function toGetProductByCategory($categoryId);
    public function toGetProductBySeller($sellerId);
    public function toGetProductByShop($shopId);
    public function toGetLatest($n);
    public function toGetProductByPriceRange($priceRange);
    public function getFilteredProducts($categoryId = null, $priceRange = null, $sort = null, $n);
}