@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Productos</h1>
    
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adminisrar Productos y Stock</h5>
              
              <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3" >
                  <i class="fa fa-plus"></i> Crear Producto
              </a>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="text-center">Categoria</th>
                    <th class="text-center">Proveedor</th>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Imagen</th>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Venta</th>
                    <th class="text-center">Compra</th>
                    <th class="text-center">Activo</th>
                    <th class="text-center"> Comprar</th>
                    <th class="text-center">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                    <tr class="text-center">

                      <td>{{ $item->categoria }}</td>
                      <td>{{ $item->proveedor }}</td>
                      <td class="text-center">{{ $item->codigo }}</td>
                      <td>{{ $item->nombre }}</td>

                      <td>
                        <img src="{{ asset('storage/' . $item->imagen) }}" 
                            alt="Imagen del producto" width="60" height="60">

                        <a href="{{ route('productos.show.image', $item->imagen_id) }}" 
                          class="badge rounded-pill bg-warning text-dark">
                            <i class="fa fa-edit"></i>
                        </a>
                      </td>

                      <td>{{ $item->descripcion }}</td>
                      <td class="text-center">{{ $item->cantidad }}</td>
                      <td class="text-center">S/ {{ $item->precio_venta }}</td>
                      <td class="text-center">S/ {{ $item->precio_compra }}</td>

                      <td>
                        <div class="form-check form-switch d-flex justify-content-center">
                          <input class="form-check-input" 
                                type="checkbox" 
                                role="switch" 
                                id="{{ $item->id }}"
                                {{ $item->activo ? 'checked' : '' }}>
                        </div>
                      </td>

                      <td>
                        <a href="{{ route('compras.create', $item->id) }}" class="btn btn-primary">
                          Comprar
                        </a>
                      </td>

                      <td>
                        <a href="{{ route('productos.edit', $item->id) }}" class="btn btn-warning btn-sm">
                          <i class="fa fa-edit"></i> Editar
                        </a>

                        <a href="{{ route('productos.show', $item->id) }}" class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i> Eliminar
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
</main>
@endsection

