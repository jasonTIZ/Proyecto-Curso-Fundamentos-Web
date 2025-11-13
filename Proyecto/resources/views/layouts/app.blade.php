<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Directorio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <form class="d-flex ms-auto" method="GET" action="{{ route('search') }}">
                    <input class="form-control form-control-sm me-2" type="search" name="q"
                        placeholder="Buscar negocios o productos" value="{{ request('q') }}" aria-label="Buscar">
                    <button class="btn btn-outline-primary btn-sm me-3" type="submit">Buscar</button>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link category-link"
                            href="{{ route('categorias.index') }}">Categorías</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="site-hero">
        <div class="container">
            <h1>Comercios recientes</h1>
            <p>Encuentra negocios locales, productos y servicios cerca de ti. Busca por categoría o explora lo más
                reciente.</p>
        </div>
    </div>

    <main class="container py-4">
        @yield('content')
    </main>

    <main class="container py-4">
        @yield('categories-content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
