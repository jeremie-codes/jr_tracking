<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\User\UserContract;
use App\Repository\Product\ProductContract;

class AccountController extends Controller
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
        $userAuth = Auth::user();
        $seller = $this->userContract->toGetById(Auth::user()->id);
        $products = $this->productContract->toGetProductBySeller($userAuth->id);

        // dd(Auth::user()->id);
        // dd($products);

        return view('my-account', [
            'seller' => $seller,
            'products' => $products,
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
    public function show(string $id)
    {
        //
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
