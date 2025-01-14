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
        //
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
        $seller = $this->userContract->toGetById(Auth::user()->id);
        $imageName = $request['image']->getClientOriginalName();

        $product = Product::create([
            'shop_id' => $seller->shop->id,
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'slug' => Str::slug($request['name']),
            'description' => $request['description'],
            'image' => $request->file('image')->storeAs('product-images', $imageName, 'public'),
            'available' => $request['available'],
            'price' => $request['price']
        ]);

        // $request['image'] = $request->file('image')->storeAs('product-images', $imageName);
        // $request['shop_id'] = $seller->shop->id;
        // $request['slug'] = Str::slug($request['name']);

        // dd($request->file('image')->storeAs('product-images', $imageName));
        // $product = $this->productContract->toAdd($request->all());

        // dd($product);

        return redirect()->route('my_account')->with('success', 'Le produit a été créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('detail-product');
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
