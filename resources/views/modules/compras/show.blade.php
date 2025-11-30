@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Eliminar Compra de Producto</h1>
    
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">⚠️ ¿Estás seguro de eliminar esta Compra?</h5>
              <p>
                Una vez eliminado la compra no se podra recuperar la informacion.
              </p>
              <!-- Table with stripped rows -->
               <table class="table">
                <thead>
                  <tr>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Canttidad</th>
                    <th class="text-center">Precio Compra</th>
                    <th class="text-center">Total Compra</th>
                    <th class="text-center">Fecha</th>
                  </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td>{{ $item->usuario_nombre }}</td>
                        <td>{{ $item->producto_nombre }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>S/ {{ $item->precio_compra }}</td>
                        <td>S/ {{ $item->precio_compra * $item->cantidad }}</td>
                        <td>{{ $item->created_at }}</td>
                        
                    </tr>
                </tbody>
              </table>

              <hr>

              <form action="{{ route('compras.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="text" name="producto_id" value="{{ $item->producto_id }}" hidden >
                <button class="btn btn-danger mt-3">Eliminar</button>
                <a href="{{ route("compras")}}" class="btn btn-info mt-3"> Cancelar</a>
              </form>
            </div>
          </div>

        </div>
      </div>
    </section>
</main>
@endsection

