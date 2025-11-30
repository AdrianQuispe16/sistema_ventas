<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class Compras extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Compras de Productos';
        $items = Compra::select(
            'compras.*',
            'users.name as usuario_nombre',
            'productos.nombre as producto_nombre'
        )
        ->join('users', 'compras.user_id', '=', 'users.id')
        ->join('productos', 'compras.producto_id', '=', 'productos.id')
        ->get();
        return view('modules.compras.index', compact('titulo', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $titulo = 'Hacer Una Compra';
        $item = Producto::find($id);
        return view('modules.compras.create', compact('titulo', 'item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try {
            $item = new Compra();
            $item->user_id = Auth::user()->id;
            $item->producto_id = $request->producto_id;
            $item->cantidad = $request->cantidad;
            $item->precio_compra = $request->precio_compra; 
            if ($item->save()) {
                $producto = Producto::find($item->producto_id);
                if ($producto) {
                    $producto->cantidad = ($producto->cantidad + $item->cantidad);
                    $producto->precio_compra = $item->precio_compra;
                    $producto->save();
                }
            }

            return to_route('productos')->with('success', 'Compra realizada exitosamente.');
        } catch (Exception $e) {
            return to_route('productos')->with('error', 'Error al comprar.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $titulo = 'Eliminar Compra de Producto';
        $item = Compra::select(
            'compras.*',
            'users.name as usuario_nombre',
            'productos.nombre as producto_nombre'
        )
        ->join('users', 'compras.user_id', '=', 'users.id')
        ->join('productos', 'compras.producto_id', '=', 'productos.id')
        ->where('compras.id', $id)
        ->first();
        return view('modules.compras.show', compact('item','titulo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
     {
        $titulo = 'Editar una Compra';
        $items = Compra::select(
            'compras.*',
            'users.name as usuario_nombre',
            'productos.nombre as producto_nombre',
            'productos.id as producto_id'
        )
        ->join('users', 'compras.user_id', '=', 'users.id')
        ->join('productos', 'compras.producto_id', '=', 'productos.id')
        ->where('compras.id', $id)
        ->first();
        return view('modules.compras.edit', compact('titulo', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /*
        Si ya se hizo una venta y se quiere actualizar la cantidad comprada,
        se debe ajustar la cantidad del producto en el inventario restando la cantidad anterior
        y sumando la nueva cantidad.
        */
        try {
            $cantidad_anterior = 0;
            $item = Compra::find($id);
            if (!$item) {
                return to_route('compras')->with('error', 'Compra no encontrada.');
            }
            $cantidad_anterior = $item->cantidad;
            $item->cantidad = $request->cantidad;
            $item->precio_compra = $request->precio_compra; 
            if ($item->save()) {
                $producto = Producto::find($item->producto_id);
                if ($producto) {
                    $cantidad_anterior = $producto->cantidad - $cantidad_anterior;
                    $producto->cantidad = $request->cantidad + $cantidad_anterior;
                    $producto->save();
                }
            }

            return to_route('compras')->with('success', 'Compra actualizada exitosamente.');
        } catch (Exception $e) {
            return to_route('compras')->with('error', 'Error al actualizar la compra.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try {
            $item = Compra::find($id);
            $cantidad_compra = $item->cantidad;
            if ($item->delete()) {
                $producto = Producto::find($request->producto_id);
                if ($producto) {
                    $producto->cantidad = $producto->cantidad - $cantidad_compra;
                    $producto->save();
                    return to_route('compras')->with('success', 'Compra eliminada exitosamente.');
                } else {
                    return to_route('compras')->with('error', 'Producto no encontrado para ajustar el inventario.');    
                }    
            }
        } catch (Exception $e) {
            return to_route('compras')->with('error', 'Error al eliminar la compra.' . $e->getMessage());
        }
    }
}
