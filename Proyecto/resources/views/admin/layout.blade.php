<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin</a>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.negocios.index') }}">Negocios</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.categorias.index') }}">Categorías</a></li>
            @if(session('admin_name'))
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">{{ session('admin_name') }}</a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <form method="POST" action="{{ route('admin.logout') }}" class="px-3 py-2">
                      @csrf
                      <button class="btn btn-sm btn-danger w-100">Cerrar sesión</button>
                    </form>
                  </li>
                </ul>
              </li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Iniciar sesión</a></li>
            @endif
          </ul>
        </div>
      </div>
    </nav>
    <main class="container py-4">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
