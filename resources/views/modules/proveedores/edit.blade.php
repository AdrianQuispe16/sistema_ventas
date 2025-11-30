@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Editar Proveedor</h1>
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

           <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Proveedor</h5>

              <form action="{{ route('proveedores.update', $item->id ) }}" class="mt-2" method="POST">
                @csrf
                @method('PUT')
                <label for="nombre" class="mt-2">Nombre de Proveedor</label>
                <input list="proveedores_list" type="text" class="form-control mt-3" value={{ $item->nombre }} name="nombre" id="nombre" autocomplete="off" required>
                <datalist id="proveedores_list"></datalist>

                <label for="telefono" class="mt-2">Telefono</label>
                <input type="text" class="form-control mt-3" value={{ $item->telefono }}  name="telefono" id="telefono">

                <label for="email" class="mt-2">Email</label>
                <input type="text" class="form-control mt-3" value={{ $item->email }}  name="email" id="email">

                <label for="cp" class="mt-2">CP</label>
                <input type="text" class="form-control mt-3" value={{ $item->cp }}  name="cp" id="cp">    

                <label for="sitio" class="mt-2">Sitio Web</label>
                <input type="text" class="form-control mt-3" value={{ $item->sitio_web }}  name="sitio_web" id="sitio_web">

                <label for="nota" class="mt-2">Notas</label>
                <textarea class="form-control mt-3"  name="nota" id="nota" rows="3"> {{ $item->nota }}</textarea>

                <button class="btn btn-primary mt-3">Actualizar</button>
                <a href="{{ route("proveedores")}}" class="btn btn-info mt-3"> Cancelar</a>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>
</main>
@endsection

