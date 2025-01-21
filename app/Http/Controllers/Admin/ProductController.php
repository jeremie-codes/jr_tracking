<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\User\UserContract;
use App\Repository\Product\ProductContract;
use App\Http\Requests\Admin\StoreProductRequest;

class ProductController extends Controller
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

        $products = $this->productContract->toGetAll();
        $categories = Category::all();

        // dd( $products->links() );

        return view('shop', data: [
            'products' => $products,
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
        $categories = Category::all();

        return view('create-product', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Récupérer le vendeur connecté
        $seller = $this->userContract->toGetById(Auth::user()->id);
        // dd($request['image2']->getClientOriginalName());

        // Enregistrer l'image principale
        $imageName = $request['image']->getClientOriginalName();
        $imagePath = $request->file('image')->storeAs('product-images', $imageName, 'public');
        // Enregistrer l'image principale
        $imageName2 = $request['image2']->getClientOriginalName();
        $imagePath2 = $request->file('image2')->storeAs('product-images', $imageName2, 'public');
        // Enregistrer l'image principale
        $imageName3 = $request['image3']->getClientOriginalName();
        $imagePath3 = $request->file('image3')->storeAs('product-images', $imageName3, 'public');

        // Créer le produit avec l'image principale
        $product = Product::create([
            'shop_id' => $seller->shop->id,
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'description' => $request['description'],
            'image' => $imagePath,
            'image2' => $imagePath2,
            'image3' => $imagePath3,
            'available' => $request['available'],
            'price' => $request['price']
        ]);

        // dd($product);

        return redirect()->route('my_account')->with('success', 'Le produit a été créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        // dd($product);


        // Récupérer l'utilisateur connecté
        $user = Auth::user();
        // dd($user->id);

        return view('detail-product', [
            'product' => $product,
            'user' => $user, // Passer l'utilisateur connecté à la vue
        ]);
    }

    public function filterProducts(Request $request)
    {
        $categoryId = $request['category_id'];
        $priceRange = $request['price_range'];
        $sort = $request['sort'];

        $products = $this->productContract->getFilteredProducts($categoryId, $priceRange, $sort, $n = 20);
        $categories = Category::all();

        $cart = session('cart', []);
        $totalItems = 0;
        $subtotal = 0;

        // Calculer le nombre total d'articles et le sous-total
        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
            $subtotal += $item['price'] * $item['quantity'];
        }

        // dd( $products->links() );

        return view('shop', data: [
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
    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->first();

        $categories = Category::all();

        return view('edit-product', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Récupérer le produit à mettre à jour
        $product = $this->productContract->toGetById($id);

        // Récupérer le vendeur connecté
        $seller = $this->userContract->toGetById(Auth::user()->id);

        // Préparer les données de mise à jour
        $updateData = [
            'shop_id' => $seller->shop->id,
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'description' => $request['description'],
            'available' => $request['available'],
            'price' => $request['price'],
        ];

        // Gérer l'image principale (image)
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->getClientOriginalName();
            $updateData['image'] = $request->file('image')->storeAs('product-images', $imageName, 'public');
        } else {
            $updateData['image'] = $product->image; // Conserver l'ancienne image
        }

        // Gérer l'image 2 (image2)
        if ($request->hasFile('image2')) {
            $imageName2 = $request->file('image2')->getClientOriginalName();
            $updateData['image2'] = $request->file('image2')->storeAs('product-images', $imageName2, 'public');
        } else {
            $updateData['image2'] = $product->image2; // Conserver l'ancienne image
        }

        // Gérer l'image 3 (image3)
        if ($request->hasFile('image3')) {
            $imageName3 = $request->file('image3')->getClientOriginalName();
            $updateData['image3'] = $request->file('image3')->storeAs('product-images', $imageName3, 'public');
        } else {
            $updateData['image3'] = $product->image3; // Conserver l'ancienne image
        }

        // Mettre à jour le produit
        $product->update($updateData);

        return redirect()->route('my_account')->with('success', 'Le produit a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productContract->toDelete($id);

        return redirect()->route('my_account')->withMessage('Le produit a été supprimé avec succès');
    }
}
