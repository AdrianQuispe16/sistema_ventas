<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Categorias extends Controller
{
    //
    public function index()
    {
        $titulo = "Categorias";
        $items = Categoria::all();
        return view('modules.categorias.index', compact('titulo', 'items'));
    }

    public function create()
    {
        $titulo = "Agregar Categoria";
        return view('modules.categorias.create', compact('titulo'));
    }

    public function store(Request $request)
    {
        try {
            $categoria = new Categoria();
            $categoria->user_id = Auth::user()->id;
            $categoria->nombre = $request->nombre;
            $categoria->save();

            return to_route('categorias')->with('success', 'Categoria guardada exitosamente.');
        } catch (Exception $e) {
            return to_route('categorias')->with('Error', 'No se pudo guardar!' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $titulo = "Detalle de Categoria";
        $item = Categoria::find($id);
        return view('modules.categorias.show', compact('titulo', 'item'));
    }

    public function destroy($id)
    {
        try {
            $categoria = Categoria::find($id);
            $categoria->delete();
            return to_route('categorias')->with('success', 'Categoria eliminada exitosamente.');
        } catch (Exception $e) {
            return to_route('categorias')->with('Error', 'No se pudo eliminar!' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $titulo = "Editar Categoria";
        $item = Categoria::find($id);
        return view('modules.categorias.edit', compact('titulo', 'item'));
    }

    public function update(Request $request, $id)
    {   try {
            $categoria = Categoria::find($id);
            $categoria->nombre = $request->nombre;
            $categoria->save();

            return to_route('categorias')->with('success', 'Categoria actualizada exitosamente.');
        } catch (Exception $e) {
            return to_route('categorias')->with('Error', 'No se pudo actualizar!' . $e->getMessage());
        }
    }
}
