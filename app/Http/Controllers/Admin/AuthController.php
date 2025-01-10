<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        dd($request->all());
    }
    public function handleRegister(RegisterRequest $request)
    {
        $$request['avatar'] = $request->file('avatar')->store('avatars', 'public');
        $user = $this->userContract->toAdd($request->all());

        Auth::login($user);

        return redirect()->intended('home');
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
