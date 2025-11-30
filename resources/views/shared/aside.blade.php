<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
      </a>
    </li>

    @can('ver-ventas')

    <!-- Ventas -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-cash-coin"></i>
        <span>Ventas</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>

      <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('ventas-nueva') }}">
            <i class="bi bi-cart-plus"></i>
            <span>Vender Producto</span>
          </a>
        </li>
        <li>
          <a href="{{ route('detalles-venta') }}">
            <i class="bi bi-receipt"></i>
            <span>Consultar Producto</span>
          </a>
        </li>
      </ul>
    </li>
    @endcan

    @can('ver-admin')

    <!-- Categorías -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('categorias') }}">
        <i class="bi bi-tags"></i>
        <span>Categorías</span>
      </a>
    </li>

    <!-- Productos -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#productos-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-box-seam"></i>
        <span>Productos</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>

      <ul id="productos-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('productos') }}">
            <i class="bi bi-box"></i>
            <span>Administrar Productos</span>
          </a>
        </li>
        <li>
          <a href="{{ route('reportes_productos') }}">
            <i class="bi bi-graph-up-arrow"></i>
            <span>Reportes Productos</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- Compras -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('compras') }}">
        <i class="bi bi-bag-check"></i>
        <span>Compras</span>
      </a>
    </li>

    <!-- Proveedores -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('proveedores') }}">
        <i class="bi bi-truck"></i>
        <span>Proveedores</span>
      </a>
    </li>

    <!-- Usuarios -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('usuarios') }}">
        <i class="bi bi-people"></i>
        <span>Usuarios</span>
      </a>
    </li>
          
    @endcan

  </ul>

</aside>
