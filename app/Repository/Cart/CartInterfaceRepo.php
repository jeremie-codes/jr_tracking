<?php

namespace App\Repository\Cart;

use App\Models\Product;

interface CartInterfaceRepo
{
    public function show();

    public function add(Product $product, $quantity);

    public function remove(Product $product);

    public function empty();
}

