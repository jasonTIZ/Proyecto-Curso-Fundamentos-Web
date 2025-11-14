<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }
      #admin-wrapper {
        display: flex;
        flex: 1;
      }
      #sidebar {
        width: 250px;
        flex-shrink: 0;
        background-color: #343a40; /* Dark background */
        color: rgba(255, 255, 255, 0.8);
        padding: 1rem;
      }
      #sidebar .nav-link {
        color: rgba(255, 255, 255, 0.7);
        padding: 0.75rem 1rem;
      }
      #sidebar .nav-link.active {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 0.25rem;
      }
      #sidebar .nav-link:hover {
        color: #fff;
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 0.25rem;
      }
      #content-wrapper {
        flex-grow: 1;
        padding: 1rem;
        background-color: #f8f9fa; /* Light background */
      }
      .sidebar-header {
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }
      .sidebar-user-info {
        padding-top: 1rem;
        margin-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
      }
    </style>
  </head>
  <body>
    <div id="admin-wrapper">
      {{-- Sidebar --}}
      <nav id="sidebar" class="d-flex flex-column">
        <div class="sidebar-header text-center">
          <a class="navbar-brand text-white fs-4" href="{{ route('admin.dashboard') }}">Admin Panel</a>
        </div>

        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.negocios.index') }}" class="nav-link {{ Request::routeIs('admin.negocios.*') ? 'active' : '' }}">
              Negocios
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.categorias.index') }}" class="nav-link {{ Request::routeIs('admin.categorias.*') ? 'active' : '' }}">
              Categorías
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.productos.index') }}" class="nav-link {{ Request::routeIs('admin.productos.*') ? 'active' : '' }}">
              Productos
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.slides.index') }}" class="nav-link {{ Request::routeIs('admin.slides.*') ? 'active' : '' }}">
              Slides
            </a>
          </li>
        </ul>

        @if(session('admin_name'))
          <div class="sidebar-user-info mt-auto">
            <p class="mb-1">Bienvenido, {{ session('admin_name') }}</p>
            <form method="POST" action="{{ route('admin.logout') }}">
              @csrf
              <button class="btn btn-sm btn-outline-light w-100">Cerrar sesión</button>
            </form>
          </div>
        @else
          <div class="sidebar-user-info mt-auto">
            <a href="{{ route('admin.login') }}" class="btn btn-sm btn-outline-light w-100">Iniciar sesión</a>
          </div>
        @endif
      </nav>

      {{-- Content Wrapper --}}
      <div id="content-wrapper">
        <header class="mb-4">
          {{-- Optional: A small top bar for notifications or other global actions --}}
          {{-- For now, just success messages --}}
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        </header>
        <main>
          @yield('content')
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>