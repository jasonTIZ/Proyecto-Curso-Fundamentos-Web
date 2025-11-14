@extends('layouts.app')

@section('title', $producto->nombre_producto)

@section('content')
    <div class="container py-5">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ route('negocios.show', $producto->negocio->id_negocio) }}">{{ $producto->negocio->nombre_negocio }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $producto->nombre_producto }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-8">
                <h1 class="fw-bold mb-3">{{ $producto->nombre_producto }}</h1>
                
                {{-- Imagen destacada --}}
                @php
                    $firstImg = $producto->imagenes->first();
                    $featuredImg = $firstImg ? $firstImg->getUrl() : 'https://via.placeholder.com/800x600?text=' . urlencode($producto->nombre_producto);
                @endphp
                <div class="mb-4">
                    <img src="{{ $featuredImg }}" alt="{{ $producto->nombre_producto }}" class="img-fluid rounded shadow-sm" style="max-height:400px; object-fit:cover; width:100%;">
                </div>

                <h4 class="fw-bold">Descripción</h4>
                <p class="text-muted">{{ $producto->descripcion ?? 'Sin descripción disponible.' }}</p>

                <h4 class="fw-bold mt-4">Precio</h4>
                <p class="fs-3 fw-bold text-primary">₡{{ number_format($producto->precio, 2) }}</p>

                {{-- Galería de imágenes --}}
                @if($producto->imagenes->count() > 1)
                    <h4 class="fw-bold mt-4">Galería</h4>
                    <div class="row g-3 mb-4">
                        @foreach($producto->imagenes as $img)
                            @if($img->id_imagen !== $firstImg->id_imagen) {{-- Evitar duplicar la imagen destacada si es la primera --}}
                                <div class="col-4 col-md-3">
                                    <a href="{{ $img->getUrl() }}" class="glightbox" data-gallery="product-gallery">
                                        <img src="{{ $img->getUrl() }}" alt="Imagen de {{ $producto->nombre_producto }}" class="img-fluid rounded shadow-sm" style="object-fit:cover; height:100px; width:100%;">
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif

                {{-- Botón para regresar --}}
                <div class="mt-4">
                    <a href="{{ route('negocios.show', ['id' => $producto->negocio->id_negocio, '#productos']) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver a los productos de {{ $producto->negocio->nombre_negocio }}
                    </a>
                </div>

            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Comercio</h5>
                        <p class="card-text">Este producto pertenece a:</p>
                        <h6 class="mb-2"><a href="{{ route('negocios.show', $producto->negocio->id_negocio) }}">{{ $producto->negocio->nombre_negocio }}</a></h6>
                        <p class="small text-muted">{{ Str::limit($producto->negocio->descripcion, 100) }}</p>
                        <a href="{{ route('negocios.show', $producto->negocio->id_negocio) }}" class="btn btn-sm btn-outline-primary">Ver Negocio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: true
    });
</script>
@endpush
