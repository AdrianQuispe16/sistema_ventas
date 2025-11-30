@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Editar Producto</h1>
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar Producto</h5>

              <form action="{{ route('productos.update', $item->id ) }}" class="mt-2" method="POST">
                @csrf
                @method('PUT')
                <label for="categoria_id" class="mt-2">Categoria</label>
                <select name="categoria_id" id="categoria_id" class="form-select" required>
                    <option value="">Seleccione una categoria</option>
                    @foreach ($categorias as $categoria)
                    @if ($categoria->id == $item->categoria_id)
                        <option selected value="{{ $categoria->id }}" selected>{{ $categoria->nombre }}</option>
                    @else
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>  
                    @endif
                    @endforeach
                </select>

                <label for="proveedor_id" class="mt-2">Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-select" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        @if ($proveedor->id == $item->proveedor_id)
                            <option selected value="{{ $proveedor->id }}" selected>{{ $proveedor->nombre }}</option>    
                        @else
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option> 
                        @endif 
                    @endforeach
                </select> 

                <label for="codigo" class="mt-2">Codigo</label>
                <input type="text" class="form-control mt-3" value="{{ $item->codigo }}" name="codigo" id="codigo" required>

                <label for="nombre" class="mt-2">Nombre de Producto</label>
                <input type="text" class="form-control mt-3" value="{{ $item->nombre }}" name="nombre" id="nombre" required>
               
                <label for="descripcion" class="mt-2">Descripcion</label>
                <textarea class="form-control mt-3" name="descripcion" id="descripcion" rows="3"> {{ $item->descripcion }}</textarea>

                <label for="precio">Precio de Venta</label>
                <input type="text" name="precio_venta" id="precio_venta" class="form-control" value="{{ $item->precio_venta }}">

                <button class="btn btn-warning mt-3">Actualizar</button>
                <a href="{{ route("productos")}}" class="btn btn-info mt-3"> Cancelar</a>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>
</main>