<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $titulo = 'Dashboard';
        $total_ventas = Venta::sum('total_venta'); 
        $cantidad_ventas = Venta::count();
        $productos_bajsto_stock = Producto::where('cantidad', '<=', 5)->get();

        $ventaReciente = Venta::orderBy('created_at', 'desc')->take(5)->get();
        return view('modules.dashboard.home', compact('titulo', 'total_ventas', 'cantidad_ventas', 'productos_bajsto_stock', 'ventaReciente'));
    }
}
