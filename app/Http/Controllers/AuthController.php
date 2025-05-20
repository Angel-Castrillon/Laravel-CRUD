<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\View\View;

class AuthController extends Controller
{
    //* Controladores de login
    public function login(): View
    {
        return view('Auth.login');
    }

    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)){
            return redirect()->intended(route('CRUD.index'))->withSuccess('Inicio de sesión exitosa!');
        }
        
        return redirect()->route('Auth.login')->withErrors('Credenciales inválidas');

    }

    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('Auth.login')->withSuccess('Cierre de sesión exitoso!');
    }

    //* Controladores de register
    public function register(): View
    {
        return view('Auth.register');
    }

    public function postRegister(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|confirmed',
            'password' => 'required|min:8|confirmed',
            'phone' => 'nullable',
            'birth_date' => 'nullable|date|before:today',
        ]);
        $data = $request->all();
        $user = $this->create($data);

        Auth::login($user);
        
        return redirect()->route('CRUD.index')->withSuccess('Registro exitoso!');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'birth_date' => $data['birth_date'],
        ]);
    }
}
