<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Detalle_venta;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class DetalleVentas extends Controller
{
    //
    public function index()
    {
        $titulo = 'Detalle de Ventas';
        $items = Venta::select(
            'ventas.*',
            'users.name as nombre_usuario'
        )
        ->join('users', 'ventas.user_id', '=', 'users.id')
        ->orderBy('ventas.created_at', 'desc')
        ->get();
        return view('modules.detalles_ventas.index', compact('titulo', 'items'));
    }

    public function detalle($id)
    {
        $titulo = 'Detalle de la Venta';
        $venta = Venta::select(
            'ventas.*',
            'users.name as nombre_usuario'
        )
        ->join('users', 'ventas.user_id', '=', 'users.id')
        ->where('ventas.id', $id)
        ->firstOrFail();

        $detalles = Detalle_venta::select(
            'detalle_ventas.*',
            'productos.nombre as nombre_producto'
        )
        ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
        ->where('detalle_ventas.venta_id', $id)
        ->get();

        return view('modules.detalles_ventas.detalle', compact('titulo', 'venta', 'detalles'));
    }

    public function revocar($id)
    {
        DB::beginTransaction();
        try {
            $detalle = Detalle_venta::select('producto_id', 'cantidad')
                ->where('venta_id', $id)
                ->get();

            // Devolver stock
            foreach ($detalle as $item) {
                Producto::where('id', $item->producto_id)
                    ->increment('cantidad', $item->cantidad); 
            }

            // Eliminar los detalles de la venta
            Detalle_venta::where('venta_id', $id)->delete();

            // Eliminar la venta
            Venta::where('id', $id)->delete();

            DB::commit();

            return redirect()->route('detalles-venta')
                ->with('success', 'Venta revertida correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('detalles-venta')
                ->with('error', 'Error al revertir la venta: ' . $e->getMessage());
        }
    }

    public function ticket($id)
    {
        $venta = Venta::select(
            'ventas.*',
            'users.name as nombre_usuario'
        )
        ->join('users', 'ventas.user_id', '=', 'users.id')
        ->where('ventas.id', $id)
        ->firstOrFail();

        $detalles = Detalle_venta::select(
            'detalle_ventas.*',
            'productos.nombre as nombre_producto'
        )
        ->join('productos', 'detalle_ventas.producto_id', '=', 'productos.id')
        ->where('detalle_ventas.venta_id', $id)
        ->get();

        $pdf = Pdf::loadView('modules.detalles_ventas.ticket', compact('venta', 'detalles'));
        return $pdf->stream("ticket_compra_{$venta->id}.pdf");
    }

}
