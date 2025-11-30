@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Detalle de la venta</h1>
    
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Detalle de la venta</h5>

              <p>
                <strong>Usuario que hizo la venta:</strong> {{ $venta->nombre_usuario }} <br>
                <strong>Total Vendido:</strong> S/ {{ $venta->total_venta }} <br>
                <strong>Fecha de Venta:</strong> {{ $venta->created_at }} <br>
              </p>
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Precio Unitario</th>
                    <th class="text-center">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($detalles as $item)
                  <tr class="text-center">
                    <td class="text-center">{{ $item->nombre_producto}}</td>
                    <td class="text-center">{{ $item->cantidad}}</td>
                    <td class="text-center">S/ {{ $item->precio_unitario}}</td>
                    <td class="text-center">S/ {{ $item->subtotal}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <hr>

              <a href="{{ route('detalles-venta') }}" class="btn btn-info">Regresar</a>
            </div>
          </div>

        </div>
      </div>
    </section>
</main>
@endsection

