<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('signin', 'login');

        $this->middleware('auth')->only('logout');
    }


    public function signin()
    {
        return view('auth.signin');
    }


    public function login(AuthRequest $request)
    {
        return Auth::attempt($request->validated(), $request->filled('remember')) ?
            redirect()->intended('/dashboard') :
            redirect()->back()->with('error', 'Invalid Credentials');
    }


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('auth.signin');
    }
}
