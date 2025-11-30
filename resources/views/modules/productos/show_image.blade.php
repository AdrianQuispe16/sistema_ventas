@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Actualizar imagen de Producto</h1>
    
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar imagen de Producto</h5>
                <form action="{{ route('productos.update.image', $item->id) }}" class="mt-2" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    
                    <label for="imagen">Nueva Imagen</label>
                    <input type="file" class="form-control mt-3" name="imagen" id="imagen" accept="image/*" required>
                    
                    <button class="btn btn-primary mt-3">Actualizar Imagen</button>
                    <a href="{{ route("productos")}}" class="btn btn-info mt-3"> Cancelar</a>
              <hr>

             
            </div>
          </div>

        </div>
      </div>
    </section>
</main>
@endsection

