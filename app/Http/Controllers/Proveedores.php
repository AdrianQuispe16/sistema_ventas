<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class Proveedores extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Proveedores';
        $items = Proveedor::all();
        return view('modules.proveedores.index', compact('items','titulo'));
    }

    /**
     * Buscar proveedores para autocompletar (JSON)
     */
    public function search(Request $request)
    {
        $q = $request->get('q', '');
        if (empty($q)) {
            return response()->json([]);
        }

        $items = Proveedor::where('nombre', 'like', "%{$q}%")
            ->orWhere('ruc', 'like', "%{$q}%")
            ->limit(10)
            ->get(['id','nombre','ruc']);

        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Agregar Proveedor';
        return view('modules.proveedores.create', compact('titulo'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'ruc' => 'nullable|string|max:20',
                'telefono' => 'nullable|string|max:20',
                'direccion' => 'nullable|string|max:255',
                'notas' => 'nullable|string',
            ]);

            $item = new Proveedor();
            $item->nombre = $request->nombre;
            $item->telefono = $request->telefono;
            $item->email = $request->email;
            $item->cp = $request->cp;
            $item->sitio_web = $request->sitio_web;
            $item->nota = $request->nota;
            $item->save();

            return to_route('proveedores')->with('success', 'Proveedor creado exitosamente.');
        } catch (\Exception $e) {
            return to_route('proveedores')->with('error', 'Fallo al crear el proveedor!!!!' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $titulo = 'Eliminar un Proveedor';
        $item = Proveedor::find($id);
        return view('modules.proveedores.show', compact('item','titulo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Proveedor::find($id);
        $titulo = 'Editar Proveedor';
        return view('modules.proveedores.edit', compact('item','titulo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'nombre' => 'required|string|max:255',
                'ruc' => 'nullable|string|max:20',
                'telefono' => 'nullable|string|max:20',
                'direccion' => 'nullable|string|max:255',
                'notas' => 'nullable|string',
            ]);

            $item = Proveedor::find($id);
            $item->nombre = $request->nombre;
            $item->telefono = $request->telefono;
            $item->email = $request->email;
            $item->cp = $request->cp;
            $item->sitio_web = $request->sitio_web;
            $item->nota = $request->nota;
            $item->save();

            return to_route('proveedores')->with('success', 'Proveedor actualizado exitosamente.');
        } catch (\Exception $e) {
            return to_route('proveedores')->with('error', 'Fallo al actualizar el proveedor!!!!' . $e->getMessage());  
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $item = Proveedor::find($id);
            $item->delete();
            return to_route('proveedores')->with('success', 'Proveedor eliminado exitosamente.');
        } catch (\Exception $e) {
            return to_route('proveedores')->with('error', 'Fallo al eliminar el proveedor!!!!' . $e->getMessage());
        }
    }
}
