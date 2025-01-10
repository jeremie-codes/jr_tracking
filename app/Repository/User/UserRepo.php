<?php

namespace App\Repository\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepo implements UserContract
{
    function login($credentials = array())
    {
        if (Auth::attempt($credentials)) {
            return true;
        } else {
            return false;
        }
    }

    function logout($id)
    {
        $user = $this->toGetById($id);
        // dd($user->tokens());

        $user->tokens()->delete();
        return true;
    }

    function createToken($id)
    {
        $user = $this->toGetById($id);
        $token = $user->createToken('API Token')->plainTextToken;
        return $token;
    }
    /**
     *
     * @param array $inputs
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toAdd(array $inputs): \Illuminate\Database\Eloquent\Model
    {
        $user = User::create($inputs);
        return $user;
    }

    /**
     *
     * @param array $inputs
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toUpdate(array $inputs, $id): \Illuminate\Database\Eloquent\Model
    {
        $user = $this->toGetById($id);
        foreach ($inputs as $property => $value)
            $user->$property = $value;
        $user->update();

        return $user;
    }

    /**
     *
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toDelete($id): \Illuminate\Database\Eloquent\Model
    {
        $user = $this->toGetById($id);
        $user->delete();
        return $user;
    }

    /**
     *
     * @param mixed $n
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toGetAll($n = 50)
    {
        $user = User::paginate($n);
        return $user;
    }

    /**
     *
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function toGetById($id): \Illuminate\Database\Eloquent\Model
    {
        $user = User::with(['shop.products'])->findOrFail($id);
        // dd($user);

        return $user;
    }

}
