@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Editar Usuario</h1>
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Usuarios</h5>

               <form action="{{ route('usuarios.update', $item->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Usuario</label>
                        <input type="text" class="form-control" name="name" id="nombre" value=" {{ $item->name }} "  required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ $item->email}}" placeholder="Ingrese email" required>
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        @if ($item->rol == 'admin')
                            <select class="form-select" name="rol" id="rol" required>
                                <option value="admin" selected>Administrador</option>
                                <option value="cajero">Cajero</option>
                            </select>
                        @else
                            <select class="form-select" name="rol" id="rol" required>
                                <option value="admin">Administrador</option>
                                <option value="cajero" selected>Cajero</option>  
                            </select>
                        @endif
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-warning">
                            <i class="fa fa-save"></i> Actualizar
                        </button>
                        <a href="{{ route('usuarios') }}" class="btn btn-secondary">
                            <i class="fa fa-times"></i> Cancelar
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

