@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Editar una Compra</h1>
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Editar de : {{ $items->producto_nombre }}</h5>

              <form action="{{ route('compras.update', $items->id) }}" class="mt-2" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="producto_id" value="{{ $items->producto_id }}">
                <label for="cantidad" class="mt-2">Cantidad del Producto</label>
                <input type="number" class="form-control mt-3" 
                value="{{ $items->cantidad }}" name="cantidad" id="cantidad" required>

                <label for="precio_compra" class="mt-2">Precio de Compra</label>
                <input type="number" step="0.01" class="form-control mt-3" value="{{ $items->precio_compra }}"
                name="precio_compra" id="precio_compra" required>
               
                <button class="btn btn-primary mt-3">Actualizar</button>
                <a href="{{ route("compras")}}" class="btn btn-info mt-3"> Cancelar</a>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>
</main>