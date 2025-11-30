@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Eliminar Categoría</h1>
  </div>
  
  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-danger">⚠️ ¿Estás seguro de eliminar esta categoría?</h5>

            <form action="{{ route('categorias.destroy', $item->id) }}" class="mt-2" method="POST">
              @csrf
              @method('DELETE')

              <label for="nombre" class="mt-2">Nombre de la categoría</label>
              <input type="text" class="form-control mt-3" readonly 
                     value="{{ $item->nombre }}" name="nombre" id="nombre">

              <div class="mt-4">
                <button type="submit" class="btn btn-danger">
                  <i class="bi bi-trash"></i> Sí, eliminar
                </button>
                <a href="{{ route('categorias') }}" class="btn btn-secondary">
                  <i class="bi bi-x-circle"></i> Cancelar
                </a>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </section>
</main>
@endsection
