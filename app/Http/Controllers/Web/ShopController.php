<?php

namespace App\Http\Controllers\Web;

use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\User\UserContract;
use App\Repository\Product\ProductContract;

class ShopController extends Controller
{
    protected ProductContract $productContract;

    protected UserContract $userContract;

    public function __construct(ProductContract $_productContract, UserContract $_userContract)
    {
        $this->productContract = $_productContract;
        $this->userContract = $_userContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session('cart', []);
        $totalItems = 0;
        $subtotal = 0;

        // Calculer le nombre total d'articles et le sous-total
        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shops = Shop::where('status', 1)->paginate(12);

        // dd($shops);
        // $products = $this->productContract->toGetAll();
        $categories = Category::all();

        // dd( $products->links() );

        return view('shop', data: [
            'shops' => $shops,
            'categories' => $categories,
            'cart' => $cart,
            'totalItems' => $totalItems,
            'subtotal' => $subtotal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // dd($slug);

        $cart = session('cart', []);
        $totalItems = 0;
        $subtotal = 0;

        // Calculer le nombre total d'articles et le sous-total
        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shops = Shop::where('status', 1);
        $shop = Shop::where('slug', $slug)
            ->with('products')
            ->first();

        // dd($shop);
        $products = $this->productContract->toGetProductByShop($shop->id, 12);
        $categories = Category::get();

        // dd( $products->links() );

        return view('show_shop', data: [
            'shops' => $shops,
            'shop' => $shop,
            'products' => $products,
            'categories' => $categories,
            'cart' => $cart,
            'totalItems' => $totalItems,
            'subtotal' => $subtotal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
