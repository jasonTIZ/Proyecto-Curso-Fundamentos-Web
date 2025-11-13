@extends('layouts.app')

@section('title', $negocio->nombre_negocio)

@section('content')
    <div class="container py-5">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                @if ($negocio->categorias && $negocio->categorias->isNotEmpty())
                    @php $categoria = $negocio->categorias->first(); @endphp
                    <li class="breadcrumb-item">
                        <a href="{{ route('categorias.show', $categoria->id_categoria_negocio) }}">
                            {{ $categoria->nombre_categoria }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $negocio->nombre_negocio }}</li>
            </ol>
        </nav>

        {{-- Título --}}
        <h1 class="fw-bold mb-4">{{ $negocio->nombre_negocio }}</h1>

        {{-- Imagen principal --}}
        @php
            $firstImg = $negocio->imagenes->first();
            $img = $firstImg
                ? $firstImg->url_imagen
                : 'https://via.placeholder.com/1200x400?text=' . urlencode($negocio->nombre_negocio);
        @endphp

        <div class="mb-4">
            <img src="{{ $img }}" alt="{{ $negocio->nombre_negocio }}" class="w-100 rounded shadow-sm"
                style="max-height:400px; object-fit:cover;">
        </div>

        {{-- Tabs --}}
        <ul class="nav nav-tabs mb-4" id="negocioTabs" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#info">Información</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                    data-bs-target="#productos">Productos</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#galeria">Galería</button>
            </li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#contacto">Contacto</button>
            </li>
        </ul>

        <div class="tab-content" id="negocioTabsContent">

            {{-- Información --}}
            <div class="tab-pane fade show active" id="info">
                <div class="row g-4">
                    <div class="col-md-8">
                        <h4 class="fw-bold">Información</h4>
                        <p class="text-muted">{{ $negocio->descripcion ?? 'Sin descripción disponible.' }}</p>
                        <ul class="list-unstyled mt-3">
                            @if ($negocio->otras_senas)
                                <li><strong>Dirección:</strong> {{ $negocio->otras_senas }}</li>
                            @endif
                            @if ($negocio->telefono)
                                <li><strong>Teléfonos:</strong> {{ $negocio->telefono }}</li>
                            @endif
                            @if ($negocio->email)
                                <li><strong>Correo:</strong> <a
                                        href="mailto:{{ $negocio->email }}">{{ $negocio->email }}</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-md-4">
                        @if ($negocio->iframe_ubicacion)
                            {!! $negocio->iframe_ubicacion !!}
                        @else
                            <img src="https://via.placeholder.com/400x250?text=Ubicación+no+disponible"
                                class="img-fluid rounded" alt="Ubicación">
                        @endif
                    </div>
                </div>
            </div>

            {{-- Productos --}}
            <div class="tab-pane fade" id="productos">
                <div class="row gy-4 mt-3">
                    @forelse($negocio->productos as $p)
                        @php
                            $firstImg = $p->imagenes->first();
                            $img = $firstImg
                                ? $firstImg->url_imagen
                                : 'https://via.placeholder.com/600x400?text=' . urlencode($p->nombre_producto);
                        @endphp
                        <div class="col-sm-6 col-md-4">
                            <article class="card h-100">
                                <img src="{{ $img }}" class="card-img-top" alt="{{ $p->nombre_producto }}"
                                    style="object-fit:cover; height:200px;">
                                <div class="card-body text-center d-flex flex-column justify-content-between">
                                    <h6 class="fw-bold">{{ $p->nombre_producto }}</h6>
                                    <p class="small text-muted mb-2">{{ Str::limit($p->descripcion, 60) }}</p>
                                    <span class="fw-bold text-dark d-block mb-2">₡{{ number_format($p->precio, 2) }}</span>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No hay productos registrados para este negocio.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Galería --}}
            <div class="tab-pane fade" id="galeria">
                <div class="row g-3 mt-3">
                    @forelse($negocio->imagenes as $img)
                        <div class="col-sm-6 col-md-4">
                            <img src="{{ $img->url_imagen }}" class="img-fluid rounded shadow-sm"
                                style="object-fit:cover; height:200px;">
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No hay imágenes disponibles.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Contacto --}}
            <div class="tab-pane fade" id="contacto">
                <div class="mt-3">
                    <h5 class="fw-bold mb-3">Contáctanos</h5>
                    <ul class="list-unstyled">
                        @if ($negocio->telefono)
                            <li><strong>Teléfono:</strong> {{ $negocio->telefono }}</li>
                        @endif
                        @if ($negocio->email)
                            <li><strong>Email:</strong> <a href="mailto:{{ $negocio->email }}">{{ $negocio->email }}</a>
                            </li>
                        @endif
                        @if ($negocio->facebook_url)
                            <li><strong>Facebook:</strong> <a href="{{ $negocio->facebook_url }}"
                                    target="_blank">{{ $negocio->facebook_url }}</a></li>
                        @endif
                        @if ($negocio->instagram_url)
                            <li><strong>Instagram:</strong> <a href="{{ $negocio->instagram_url }}"
                                    target="_blank">{{ $negocio->instagram_url }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>
    </div>
@endsection
