@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dettalle de ventas hechas</h1>
    
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Revisar ventas Existentes</h5>
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="text-center">Total Vendido</th>
                    <th class="text-center">Fecha venta</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Ver detalle</th>
                    <th class="text-center">Imprimir Ticket</th>
                    <th class="text-center">Revocar venta</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                  <tr class="text-center">
                    <td class="text-center">{{ $item->total_venta}}</td>
                    <td class="text-center">{{ $item->created_at}}</td>
                    <td class="text-center">{{ $item->nombre_usuario}}</td>
                    <td class="text-center">
                        <a href="{{ route('detalle.venta', $item->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-eye"></i> Ver Detalle
                        </a>
                    </td>
                    <td class="text-center">
                        <a target="_blank" href="{{ route('ticket.venta', $item->id) }}" class="btn btn-success btn-sm" target="_blank">
                            <i class="fa fa-print"></i> Imprimir Ticket
                        </a>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('detalle.venta.revocar', $item->id) }}" method="POST" onsubmit="return confirm('Esta seguro de revocar la venta??')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Revocar Venta</button>
                        </form>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </section>
</main>
@endsection

