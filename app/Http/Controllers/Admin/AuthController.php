<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repository\User\UserContract;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    protected UserContract $userContract;

    public function __construct(UserContract $_userContract)
    {
        $this->userContract = $_userContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function loginView()
    {
        return view('auth.login');
    }
    public function registerView()
    {
        return view('auth.register');
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
    public function handleLogin(LoginRequest $request)
    {
        $user = $this->userContract->login($request->only(['email', 'password']));

        if ($user) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }
        return redirect()->back()->with('error', 'Utilisateur non trouvé');
    }
    public function handleRegister(RegisterRequest $request)
    {
        $data = $request->all();

        if (!$request['shop_name']) {
            $request['shop_name'] = $request['name'];
        }
        $data['slug'] = Str::slug('shop_name');

        $request->validate([
            'shop_name' => [
                'required',
                'string',
                'max:255',
                'unique:shops,slug' // Assurez-vous que la colonne slug existe dans votre table shops
            ],
        ], [
            'shop_name.unique' => 'Le nom de la boutique est déjà pris.',
        ]);

        $request['password'] = Hash::make($request['password']);

        if ($request->file('avatar')) {
            $request['avatar'] = $request->file('avatar')->store('avatars', 'public');
            $user = $this->userContract->toAdd($request->all());
        } else {
            $user = $this->userContract->toAdd($request->except('avatar'));
        }

        if ($request->file('image')) {
            $shop = Shop::create([
                'user_id' => $user->id,
                'name' => $request['shop_name'],
                'image' => $request->file('image')->store('shop-images', 'public'),
                'slug' => $data['slug']
            ]);
        } else {
            $shop = Shop::create([
                'user_id' => $user->id,
                'name' => $request['shop_name'],
                'image' => '',
                'slug' => $data['slug']
            ]);
        }

        if ($shop) {
            Auth::login($user);

            return redirect()->intended('/');
        } else {
            dd('shop non créé');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->intended('/');
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
        // dd($request->all());

        $user = $this->userContract->toGetById($id);

        $data = $request->except(['_method', '_token', 'old_password', 'new_password', 'password_confirmation', 'shop_name']);

        $shop = Shop::findOrFail($user->shop->id);
        $shop->update([
            'name' => $request['shop_name'],
            'image' => $request->file('image')->store('shop-images', 'public')
        ]);

        // dd($shop);

        $user = $this->userContract->toUpdate($data, $id);

        if ($request->filled('old_password')) {
            $passwordData = $request->validate([
                'old_password' => 'required|string|min:8',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withErrors(['old_password' => 'L\'ancien mot de passe est incorrect.']);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->back()->with('success', 'Vos informations et votre mot de passe ont été mis à jour.');
        }

        return redirect()->back()->with('success', 'Vos informations ont été mises à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
