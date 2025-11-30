@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">

  <div class="pagetitle mb-4">
    <h1 class="fw-bold">📊 Dashboard</h1>
    <p class="text-muted">Resumen general del sistema</p>
  </div>
  
  <section class="section">
    <div class="row">

      <!-- BIENVENIDA -->
      <div class="col-12 mb-4">
        <div class="card border-0 shadow-sm text-white"
             style="background: linear-gradient(135deg, #0d6efd, #0b5ed7); border-radius:15px;">
          <div class="card-body py-4 px-4">
            <h4 class="mb-1">Bienvenido, <strong>{{ Auth::user()->name }}</strong> 👋</h4>
            <small>Estamos listos para comenzar tu jornada</small>
          </div>
        </div>
      </div>

      <!-- TOTAL VENTAS -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 shadow h-100" style="border-radius:15px;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">

              <div class="me-3">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width:65px; height:65px;">
                  <i class="bi bi-currency-dollar fs-2"></i>
                </div>
              </div>

              <div>
                <h6 class="text-muted mb-1">Total de ventas</h6>
                <h2 class="fw-bold mb-0">S/ {{ number_format($total_ventas) }}</h2>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- CANTIDAD VENTAS -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-0 shadow h-100" style="border-radius:15px;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">

              <div class="me-3">
                <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width:65px; height:65px;">
                  <i class="bi bi-cart-check fs-2"></i>
                </div>
              </div>

              <div>
                <h6 class="text-muted mb-1">Cantidad de ventas</h6>
                <h2 class="fw-bold mb-0">{{ $cantidad_ventas }}</h2>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- PRODUCTOS BAJO STOCK -->
      <div class="col-xl-4 col-md-12 mb-4">
        <div class="card border-0 shadow h-100" style="border-radius:15px;">
          <div class="card-body p-4">
            <div class="d-flex align-items-center">

              <div class="me-3">
                <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width:65px; height:65px;">
                  <i class="bi bi-exclamation-triangle fs-2"></i>
                </div>
              </div>

              <div>
                <h6 class="text-muted mb-1">Productos con bajo stock</h6>
                <h2 class="fw-bold mb-0">{{ count($productos_bajsto_stock) }}</h2>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- ULTIMAS VENTAS -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius:15px;">
          <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4 class="fw-bold mb-0">
                <i class="bi bi-clock-history text-primary"></i> Últimas ventas
              </h4>
            </div>

            <div class="table-responsive">
              <table class="table table-hover align-middle">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($ventaReciente as $venta)
<tr>
  <td>
    <span class="fw-bold text-primary">
      Venta #{{ $venta->id }}
    </span>
  </td>
  <td>
    <span class="badge bg-success fs-6">
      S/ {{ number_format($venta->total_venta, 2) }}
    </span>
  </td>
  <td>
    <i class="bi bi-calendar-check text-muted"></i>
    {{ $venta->created_at->format('d/m/Y H:i') }}
  </td>
</tr>
@endforeach

                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>

  </section>
</main>
@endsection
