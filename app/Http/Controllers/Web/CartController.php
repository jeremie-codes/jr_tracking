<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Cart\CartInterfaceRepo;

class CartController extends Controller
{
    protected $cartRepo;

    public function __construct(CartInterfaceRepo $_cartRepo)
    {
        $this->cartRepo = $_cartRepo;
    }

    public function show()
    {
        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(Product $product, Request $request)
    {
        // dd($request->all());
        $quantity = $request->quantity;

        if (!$request->quantity) {
            $quantity = 1;
        }

        // dd($quantity);

        // Ajout/Mise à jour du produit au panier avec sa quantité
        $this->cartRepo->add($product, $quantity);

        // Redirection vers le panier avec un message
        return redirect()->route("cart")->withMessage("Produit rajouté au panier");
    }

    public function remove(Product $product)
    {

        // Suppression du produit du panier par son identifiant
        $this->cartRepo->remove($product);

        // Redirection vers le panier
        return back()->withMessage("Produit retiré du panier");
    }

    public function empty()
    {

        // Suppression des informations du panier en session
        $this->cartRepo->empty();

        // Redirection vers le panier
        return back()->withMessage("Panier vidé");

    }
}
