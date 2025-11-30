<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Imagen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Productos extends Controller
{
    //
    public function index()
    {
        $titulo = 'Productos';  
        $items = Producto::select(
            'productos.*',
            'categorias.nombre AS categoria',
            'proveedores.nombre AS proveedor',
            'imagenes.ruta AS imagen',
            'imagenes.id AS imagen_id'
        )
        ->leftJoin('categorias', 'productos.categoria_id', '=','categorias.id')
        ->leftJoin('proveedores', 'productos.proveedor_id', '=', 'proveedores.id')
        ->join('imagenes', 'productos.id', '=', 'imagenes.producto_id')
        ->get();
        return view('modules.productos.index', compact('titulo', 'items'));
    }

    public function create()
    {
        $titulo = 'Agregar Producto'; 
        $categorias = Categoria::all(); 
        $proveedores = Proveedor::all();
        return view('modules.productos.create', compact('titulo', 'categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        try {
            $item = new Producto();
            $item->user_id = Auth::user()->id;
            $item->categoria_id = $request->categoria_id;
            $item->proveedor_id = $request->proveedor_id;
            $item->codigo = $request->codigo;
            $item->nombre = $request->nombre;
            $item->descripcion = $request->descripcion;

            $item->save();

            $id_producto = $item->id;
            if ( $id_producto > 0 ){
                if ($this->subir_imagen($request, $id_producto)) {
                    return to_route('productos')->with('success', 'Producto actualizado exitosamente.');
                } else {
                    return to_route('productos')->with('warning', 'Producto actualizado pero fallo al subir la imagen.');
                }   
            }

            return to_route('productos')->with('success', 'Producto creado exitosamente.');
        } catch (\Exception $e) {
            return to_route('categorias')->with('Error', 'Error al crear el producto!' . $e->getMessage());
        }
    }

    public function subir_imagen($request, $id_producto)
    {
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('imagenes', 'public'); 
            $nombreImagen = basename($rutaImagen);

            $item = new Imagen();
            $item->producto_id = $id_producto;
            $item->nombre = $nombreImagen;
            $item->ruta = $rutaImagen;
            return $item->save();
        }
        return false;
    }

    public function edit($id)
    {
        $titulo = 'Editar Producto'; 
        $item = Producto::find($id);
        $categorias = Categoria::all(); 
        $proveedores = Proveedor::all();
        return view('modules.productos.edit', compact('titulo', 'item', 'categorias', 'proveedores'));
    }

    public function update(Request $request)
    {
        try {
            $item = Producto::find($request->id);
            $item->user_id = Auth::user()->id;
            $item->categoria_id = $request->categoria_id;
            $item->proveedor_id = $request->proveedor_id;
            $item->codigo = $request->codigo;
            $item->nombre = $request->nombre;
            $item->descripcion = $request->descripcion;
            $item->precio_venta = $request->precio_venta;

            $item->save();

            return to_route('productos')->with('success', 'Producto actualizado exitosamente.');
        } catch (\Exception $e) {
            return to_route('productos')->with('Error', 'Error al actualizar el producto!' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $titulo = 'Eliminar un Producto';
        $items = Producto::select(
            'productos.*',
            'categorias.nombre AS categoria',
            'proveedores.nombre AS proveedor'
        )
        ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
        ->leftJoin('proveedores', 'productos.proveedor_id', '=', 'proveedores.id')
        ->where('productos.id', $id)
        ->first();

        return view('modules.productos.show', compact('items','titulo'));
    }

    public function destroy($id)
    {
        try {
            $item = Producto::find($id);
            $item->delete();
            return to_route('productos')->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            return to_route('productos')->with('error', 'Fallo al eliminar el producto!!!!' . $e->getMessage());
        }
    }

    public function show_image($id)
    {
        $titulo = 'Editar Imagen del Producto';
        $item = Imagen::find($id);
        return view('modules.productos.show_image', compact('item','titulo'));
    }

    public function update_image(Request $request, $id)
    {
        try {
            $item = Imagen::find($id);
            if ($item->ruta && Storage::disk('public')->exists($item->ruta)) {
                Storage::disk('public')->delete($item->ruta);
            }
            
            $rutaImagen = $request->file('imagen')->store('imagenes', 'public'); 
            $nombreImagen = basename($rutaImagen);
            $item->ruta = $rutaImagen;
            $item->nombre = $nombreImagen;
            $item->save();

            return to_route('productos')->with('success', 'Imagen del producto actualizada exitosamente.');
        } catch (\Exception $e) {
            return to_route('productos')->with('error', 'Fallo al actualizar la imagen del producto!!!!' . $e->getMessage());
        }
    }   
}
