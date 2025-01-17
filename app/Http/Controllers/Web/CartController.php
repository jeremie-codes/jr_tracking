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
        $cart = session('cart', []);
        $subtotal = 0;

        // Calculer le sous-total
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Frais de livraison (exemple : gratuit par défaut)
        $shipping = 0;

        // Taxes (exemple : 8% du sous-total)
        $taxRate = 0.08;
        $tax = $subtotal * $taxRate;

        // Total
        $total = $subtotal + $shipping + $tax;

        return view('cart', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax' => $tax,
            'total' => $total,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(Product $product, Request $request)
    {
        $quantity = $request->quantity;

        if (!$request->quantity) {
            $quantity = 1;
        }

        // Ajout/Mise à jour du produit au panier avec sa quantité
        $this->cartRepo->add($product, $quantity);

        // Redirection vers le panier avec un message
        return redirect()->route("cart")->withMessage("Produit rajouté au panier");
    }

    public function updateMultiple(Request $request)
    {
        $quantities = $request->input('quantities'); // Récupérer les quantités

        if (is_array($quantities)) {
            $cart = session('cart', []);

            foreach ($quantities as $productId => $quantity) {
                if (isset($cart[$productId])) {
                    // Mettre à jour la quantité du produit dans le panier
                    $cart[$productId]['quantity'] = $quantity;
                }
            }

            session()->put('cart', $cart); // Mettre à jour la session
        }

        return redirect()->route('cart')->withMessage('Panier mis à jour avec succès.');
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

    public function checkout()
    {
        $cart = session('cart', []);
        $subtotal = 0;

        // Calculer le sous-total
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $total = $subtotal;

        return view('checkout', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }
}
