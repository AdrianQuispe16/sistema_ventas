<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\Detalle_venta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Ventas extends Controller
{
    //
    public function index()
    {
        $titulo = 'Ventas de Productos';
        $items = Producto ::all();
        return view('modules.ventas.index', compact('titulo', 'items'));
    }

    public function agregarAlCarrito($id_producto)
    {
        $titulo = 'Ventas de Productos';
        //
        $item = Producto::find($id_producto);

        $disponible = $item->cantidad;

        /* Verificar si el producto existe */
        $items_carrito = Session::get('items_carrito', []);

        $existe = false;
        foreach ($items_carrito as &$producto_carrito) {
            if ($producto_carrito['id'] == $item->id) {
                if ($producto_carrito['cantidad'] < $disponible) {
                    $producto_carrito['cantidad'] += 1;
                } else {
                    return to_route('ventas-nueva')->with('error', 'Cantidad disponible no suficiente en inventario.');
                }   

                $existe = true;
                break;
            }
        }

        /* Agregar el nuevo producto al carrito */

        if (! $existe) {
            $items_carrito[] = [
                'id' => $item->id,
                'codigo' => $item->codigo,
                'nombre' => $item->nombre,
                'precio_venta' => $item->precio_venta,
                'cantidad' => 1,
            ];
        }
        Session::put('items_carrito', $items_carrito);
        $items = Producto ::all();
        return view('modules.ventas.index', compact('titulo', 'items'));
 
    }

    public function quitarDelCarrito($id_producto)
    {
        $items_carrito = Session::get('items_carrito', []);

        foreach ($items_carrito as $key => $producto_carrito) {
            if ($producto_carrito['id'] == $id_producto) {
                if ($producto_carrito['cantidad'] > 1) {
                    $items_carrito[$key]['cantidad'] -= 1;
                } else {
                    unset($items_carrito[$key]);
                }
                break;
            }
        }

        Session::put('items_carrito', $items_carrito);

        return to_route('ventas-nueva');
    }

    public function borrar_carrito()
    {
        Session::forget('items_carrito');
         return to_route('ventas-nueva');
    }

    public function guardarVenta()
    {
        $items_carrito = Session::get('items_carrito', []);

        // Verificar si el carrito está vacío
        if (empty($items_carrito)) {
            return to_route('ventas-nueva')->with('error', 'El carrito de ventas está vacío.');
        }

        DB::beginTransaction();

        try {

            // Calcular el total
            $total = 0;
            foreach ($items_carrito as $producto_carrito) {
                $total += $producto_carrito['precio_venta'] * $producto_carrito['cantidad'];
            }

            // Crear la venta
            $venta = new Venta();
            $venta->user_id = Auth::user()->id;
            $venta->total_venta = $total;   // ← CORREGIDO
            $venta->save();

            // Crear los detalles
            foreach ($items_carrito as $producto_carrito) {

                $producto = Producto::find($producto_carrito['id']);

                // validar stock
                if ($producto->cantidad < $producto_carrito['cantidad']) {
                    DB::rollBack();
                    return back()->with('error', 'Stock insuficiente para: ' . $producto->nombre);
                }

                // Guardar detalle
                $detalle = new Detalle_venta();
                $detalle->venta_id = $venta->id;
                $detalle->producto_id = $producto_carrito['id'];
                $detalle->cantidad = $producto_carrito['cantidad'];
                $detalle->precio_unitario = $producto_carrito['precio_venta']; // ← CORREGIDO
                $detalle->subtotal = $producto_carrito['precio_venta'] * $producto_carrito['cantidad'];
                $detalle->save();

                // Actualizar stock
                $producto->cantidad -= $producto_carrito['cantidad'];
                $producto->save();
            }

            // limpiar carrito
            Session::forget('items_carrito');

            DB::commit();

            return to_route('ventas-nueva')->with('success', 'Venta guardada exitosamente.');

        } catch (\Exception $e) {

            DB::rollBack();
            return to_route('ventas-nueva')
                ->with('error', 'Error al guardar la venta: ' . $e->getMessage());
        }
    }
}
