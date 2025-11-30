@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Proveedores</h1>
    
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adminisrar los Proveedores</h5>
              <p>
                Adminisrar nuestras proveedores de nuestro productos
              </p>
              <a href="{{ route('proveedores.create') }}" class="btn btn-primary mb-3" >
                  <i class="fa fa-plus"></i> Agregar Nuevo Proveedor
              </a>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="text-center">Nombre Proveedor</th>
                    <th class="text-center">Telefono</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">CP</th>
                    <th class="text-center">Sitio Web</th>
                    <th class="text-center">Nota</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $items as $item )
                  <tr class="text-center">
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->cp }}</td>
                    <td>{{ $item->sitio_web }}</td>
                    <td>{{ $item->notas }}</td>
                    <td>
                        <a href="{{ route('proveedores.edit', $item->id ) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('proveedores.show', $item->id ) }}" class="btn btn-danger btn-sm">
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

