@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Categorias</h1>
    
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adminisrar Categorias</h5>
              <p>
                Adminisrar nuestras catgorias de nuestro productos
              </p>
              <a href="{{ route("categorias.create")}}" class="btn btn-primary mb-3" >
                  <i class="fa fa-plus"></i> Agregar Nueva Categoria
              </a>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="text-center">Nombre Categoria</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($items as $item)
                  <tr class="text-center">
                    <td>{{ $item->nombre}}</td>
                    <td>
                        <a href="{{ route("categorias.edit", $item->id  )}}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                        <a href="{{ route("categorias.show", $item->id  )}}" class="btn btn-danger btn-sm">
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

