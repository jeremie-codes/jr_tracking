<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\User\UserContract;

class HomeController extends Controller
{
    protected UserContract $userContract;

    public function __construct(UserContract $_userContract)
    {
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

        if (Auth::user()) {
            $user = $this->userContract->toGetById(Auth::user()->id);

            return view('home', [
                'user' => Auth::user(),
                'cart' => $cart,
                'totalItems' => $totalItems,
                'subtotal' => $subtotal,
            ]);
        }
        return view('home', [
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
