<?php

namespace App\Repository\Order;

use App\Models\Order;

class OrderRepo implements OrderContract
{
    /**
     *
     * @param array $inputs
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toAdd(array $inputs): \Illuminate\Database\Eloquent\Model
    {
        $order = Order::create($inputs);
        return $order;
    }

    /**
     *
     * @param array $inputs
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toUpdate(array $inputs, $id): \Illuminate\Database\Eloquent\Model
    {
        $order = $this->toGetById($id);
        foreach ($inputs as $property => $value)
            $order->$property = $value;
        $order->update();

        return $order;
    }

    /**
     *
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toDelete($id): \Illuminate\Database\Eloquent\Model
    {
        $order = $this->toGetById($id);
        $order->delete();
        return $order;
    }

    /**
     *
     * @param mixed $n
     */
    public function toGetAll($n = 20)
    {
        $order = Order::with('category', 'shop')
            ->paginate($n);
        return $order;
    }

    /**
     *
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toGetById($id): \Illuminate\Database\Eloquent\Model
    {
        return Order::findOrFail($id);
    }
}
