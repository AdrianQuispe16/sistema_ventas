@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Agregar Producto</h1>
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Agregar Nuevo Producto</h5>

              <form action="{{route('productos.store')}}" class="mt-2" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="categoria_id" class="mt-2">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-select" required>
                    <option value="">Seleccione una categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>  
                    @endforeach
                </select>

                <label for="proveedor_id" class="mt-2">Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-select" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>  
                    @endforeach
                </select> 

                <label for="codigo" class="mt-2">Codigo</label>
                <input type="text" class="form-control mt-3" name="codigo" id="codigo" required>

                <label for="nombre" class="mt-2">Nombre de Producto</label>
                <input type="text" class="form-control mt-3" placeholder="Ingrese Nombre de Producto" name="nombre" id="nombre" required>
               
                <label for="descripcion" class="mt-2">Descripcion</label>
                <textarea class="form-control mt-3" placeholder="Ingrese descripcion" name="descripcion" id="descripcion" rows="3"></textarea>

                
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control mt-3" name="imagen" id="imagen" accept="image/*">
                
                <button class="btn btn-primary mt-3">Guardar</button>
                <a href="{{ route("productos")}}" class="btn btn-info mt-3"> Cancelar</a>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>
</main>