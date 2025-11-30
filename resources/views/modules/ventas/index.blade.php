@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Ventas de Productos </h1>
    
  </div>
  
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Crear un nueva venta</h5>
              <p>
                Crear una nueva venta de productos existentes en el sistema.
              </p>
              <!-- Table with stripped rows -->
              <table class="table table-centered" id="productos_carrito">
                <thead>
                  <tr>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Canidad</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Acción</th>
                  </tr>
                </thead>
                  <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td class="text-center">{{ $item->codigo }}</td>
                        <td class="text-center">{{ $item->nombre }}</td>
                        <td class="text-center">{{ $item->cantidad }}</td>
                        <td class="text-center">S/. {{ $item->precio_venta }}</td>
                        <td class="text-center">
                            <a href="{{ route("ventas.agregar.al.carrito", $item->id) }}" class="btn btn-success btn-sm">
                                Agregar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Carrito de Compras</h5>
               
              @if (session()->has('items_carrito') && count(session('items_carrito')) > 0)
                  <table class="table table-centered">
                    <thead>
                      <tr>
                        <th class="text-center">Codigo</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Quitar</th>
                      </tr>
                    </thead>
                      <tbody>
                        @php
                          $totalGeneral = 0;
                        @endphp
                        @foreach (session('items_carrito') as $item_carrito)
                        @php
                          $totalProduto = $item_carrito ['cantidad'] * $item_carrito ['precio_venta'];
                          $totalGeneral += $totalProduto;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $item_carrito['codigo'] }}</td>
                            <td class="text-center">{{ $item_carrito['nombre'] }}</td>
                            <td class="text-center">{{ $item_carrito['cantidad'] }}</td>
                            <td class="text-center">S/. {{ $totalProduto }}</td>
                            <td class="text-center">
                                <a href="{{ route("ventas.quitar.del.carrito", $item_carrito['id']) }}" class="btn btn-danger btn-sm">
                                    Quitar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tfoot>
                            <td colspan="3" class="text-end"><strong>Total General:</strong></td>
                            <td class="text-center"><strong>{{ $totalGeneral }}</strong></td>
                            <td>
                        </tfoot> 
                      </tbody>
                  </table>
                  <hr>
                  <div class="row">
                     <div class="col">
                      <form action="{{ route("ventas.guardar.venta") }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Guardar Venta</button>
                      </form>
                     </div>
                     <div class="col text-end">
                         <a href="{{ route("ventas.borrar.carrito", $item->id) }}" class="btn btn-danger"> Borrar Carrito</a>
                     </div>
                  </div>
              @else
              @endif
              
            </div>
          </div>
        </div>
      </div>
    </section>
  
  </main>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      if ($.fn.DataTable.isDataTable('#productos_carrito')) {
          $('#productos_carrito').DataTable().destroy();
      }

      $('#productos_carrito').DataTable({
          "pageLength": 2,
          language: {
          "decimal": "",
          "emptyTable": "No hay información",
          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
          "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Mostrar _MENU_ Entradas",
          "loadingRecords": "Cargando...",
          "processing": "Procesando...",
          "search": "Buscar:",
          "zeroRecords": "Sin resultados encontrados",
          "paginate": {
              "first": "Primero",
              "last": "Ultimo",
              "next": "Siguiente",
              "previous": "Anterior"
          }
        }
      });
  });
  </script>
@endpush