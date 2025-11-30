@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Hacer Una Compra</h1>
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Compra Nueva de: {{ $item->nombre }}</h5>

              <form action="{{route('compras.store')}}" class="mt-2" method="POST">
                @csrf 
                
                <input type="hidden" name="producto_id" value="{{ $item->id }}">
                <label for="cantidad" class="mt-2">Cantidad</label>
                <input type="number" class="form-control mt-3" placeholder="Ingrese Cantidad" name="cantidad" id="cantidad" required>

                <label for="precio_compra" class="mt-2">Precio de Compra</label>
                <input type="number" step="0.01" class="form-control mt-3" placeholder="Ingrese Precio de compra" 
                name="precio_compra" id="precio_compra" required>
               
                <button class="btn btn-primary mt-3">Comprar</button>
                <a href="{{ route("productos")}}" class="btn btn-info mt-3"> Cancelar</a>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>
</main>