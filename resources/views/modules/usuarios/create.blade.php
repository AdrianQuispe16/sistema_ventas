@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Agregar Usuarios</h1>
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Agregar Nueva Usuarios</h5>

                <form action="{{ route('usuarios.store') }}" method="POST" class="mt-3">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Usuario</label>
                        <input type="text" class="form-control" name="name" id="nombre" placeholder="Ingrese nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Ingrese email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Ingrese contraseña" required>
                    </div>

                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select class="form-select" name="rol" id="rol" required>
                            <option value="">Seleccione Rol</option>
                            <option value="Admin">Administrador</option>
                            <option value="Cajero">Cajero</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Guardar
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

