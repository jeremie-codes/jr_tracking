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

    public function toGetLatest($n)
    {
        return Product::latest($n);
    }

    public function toGetProductByPriceRange($priceRange)
    {
        // Vérifier si la chaîne contient bien le séparateur ' - '
        if (strpos($priceRange, ' - ') === false) {
            throw new \InvalidArgumentException("Le format de la plage de prix est invalide.");
        }

        // Séparer la chaîne en deux valeurs : min et max
        [$minPrice, $maxPrice] = array_map('intval', explode(' - ', $priceRange));

        // Récupérer les produits dans la gamme de prix
        return Product::whereBetween('price', [$minPrice, $maxPrice])->get();
    }

    public function getFilteredProducts($categoryId = null, $priceRange = null, $sort = null, $n)
    {
        // Commencer avec une requête de base
        $query = Product::query();

        // Filtrer par catégorie si un `categoryId` est fourni
        if (!is_null($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        // Filtrer par gamme de prix si un `priceRange` est fourni
        if (!is_null($priceRange)) {
            $prices = explode(' - ', $priceRange);
            if (count($prices) === 2) {
                [$minPrice, $maxPrice] = $prices;
                $query->whereBetween('price', [(int) $minPrice, (int) $maxPrice]);
            } else {
                // Gérer le cas où le format de `priceRange` est invalide
                throw new \InvalidArgumentException('Le format de la gamme de prix est invalide.');
            }
        }

        // Appliquer un tri si un `sort` est fourni
        if (!is_null($sort)) {
            switch ($sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    // Gérer le cas où la valeur de `sort` est inconnue
                    throw new \InvalidArgumentException('Le critère de tri est invalide.');
            }
        }

        // Exécuter la requête et récupérer les produits
        return $query->paginate($n);
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
    public function toGetAll($n = 20)
    {
        $product = Product::with('category', 'shop')
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
