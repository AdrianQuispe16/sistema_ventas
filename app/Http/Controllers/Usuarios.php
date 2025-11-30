<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Usuarios extends Controller
{
    //
    public function index()
    {
        $titulo = 'Usuarios';   
        $items = User::all(); 
        return view('modules.usuarios.index', compact('titulo', 'items'));
    }

    public function create()
    {
        $titulo = 'Agregar Usuario';   
        return view('modules.usuarios.create', compact('titulo'));
    }

    public function store(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->rol = $request->rol;
            $user->activo = true ;
            $user->save();

            return to_route('usuarios')->with('success', 'Usuario creado exitosamente.');
        } catch (Exception $e) {
            return to_route('usuarios')->with('error', 'Error al guardar usuario.' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $titulo = 'Editar Usuario';   
        $item = User::find($id);
        return view('modules.usuarios.edit', compact('titulo', 'item'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->rol = $request->rol;
            $user->save();

            return to_route('usuarios')->with('success', 'Usuario actualizado exitosamente.');
        } catch (Exception $e) {
            return to_route('usuarios')->with('error', 'Error al actualizar usuario.' . $e->getMessage());
        }
    }

    public function tbody()
    {
        $items = User::all(); 
        return view('modules.usuarios.tbody', compact('items'));
    }

    public function estado($id, $estado)
    {
        $item = User::find($id);
        $item->activo = $estado;
        return $item->save();
    }

    public function cambiar_Password($id, $password)
    {
        $user = User::find($id);
        $user->password = Hash::make($password);
        return $user->save();
    }  
}
