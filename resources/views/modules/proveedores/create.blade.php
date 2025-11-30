@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Agregar Proveedor</h1>
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Agregar Nueva Proveedor</h5>

              <form action="{{ route('proveedores.store') }}" class="mt-2" method="POST">
                @csrf
                <label for="nombre" class="mt-2">Nombre de Proveedor</label>
                <input list="proveedores_list" type="text" class="form-control mt-3" placeholder="Ingrese Nombre de proveedor" name="nombre" id="nombre" autocomplete="off" required>
                <datalist id="proveedores_list"></datalist>

                <label for="telefono" class="mt-2">Telefono</label>
                <input type="text" class="form-control mt-3" placeholder="Ingrese Telefono" name="telefono" id="telefono">

                <label for="email" class="mt-2">Email</label>
                <input type="text" class="form-control mt-3" placeholder="Ingrese Email" name="email" id="email">

                <label for="cp" class="mt-2">CP</label>
                <input type="text" class="form-control mt-3" placeholder="Ingrese CP" name="cp" id="cp">    

                <label for="sitio" class="mt-2">Sitio Web</label>
                <input type="text" class="form-control mt-3" placeholder="Ingrese Sitio Web" name="sitio_web" id="sitio_web">

                <label for="nota" class="mt-2">Notas</label>
                <textarea class="form-control mt-3" placeholder="Ingrese Notas" name="nota" id="nota" rows="3"></textarea>

                <button class="btn btn-primary mt-3">Guardar</button>
                <a href="{{ route("proveedores")}}" class="btn btn-info mt-3"> Cancelar</a>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>
</main>