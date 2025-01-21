<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\User\UserContract;
use App\Repository\Product\ProductContract;

class OrderController extends Controller
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
        $orders = Order::with('order_items')->get();

        // dd($orders);

        $statusTranslations = [
            'pending' => 'En attente',
            'paid' => 'Payé',
            'cancelled' => 'Annulé',
            'failed' => 'Échoué',
        ];

        return view('orders', [
            'orders' => $orders,
            'statusTranslations' => $statusTranslations, // Passer le tableau à la vue
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
