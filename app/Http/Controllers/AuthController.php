<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;    

class AuthController extends Controller
{
    public function index()
    {
        $titulo = "Login de Usuario";
        return view('modules.auth.login', compact('titulo'));
    }

    public function logear(Request $request)
    {
        // Validar las credenciales
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscar el usuario por email y activo
        $user = \App\Models\User::where('email', $request['email'])->first();

        if(!$user || !Hash::check($request['password'], $user->password)) {
            return back()->withErrors(['email' => 'Credenciales incorrectos '])->withInput();
        }

        // El usuario está inactivo
        if (!$user->activo) {
            return back()->withErrors(['email' => 'Usuario inactivo'])->withInput();
        }

        // Crear sesión para el usuario
        Auth::login($user);
        $request->session()->regenerate();

        // Intentar autenticar al usuario
        return to_route('home');
    }

    public function crearAdmin(){
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123') ,
            'rol' => 'admin',
            'activo' => true,
        ]);

        return "Usuario admin creado";
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('login');
    }
}
