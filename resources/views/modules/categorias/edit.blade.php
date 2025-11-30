@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Editar Categorias</h1>
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Categoria</h5>

              <form action="{{ route('categorias.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{ $item->nombre }}" class="form-control">

                <button type="submit" class="btn btn-success mt-2">
                    <i class="fa fa-edit"></i> Actualizar</button>
                <a href="{{ route('categorias') }}" class="btn btn-secondary">
                  <i class="bi bi-x-circle" mt-2></i> Cancelar
                </a>
            </form>

            </div>
          </div>

        </div>
      </div>
    </section>
</main>
@endsection

