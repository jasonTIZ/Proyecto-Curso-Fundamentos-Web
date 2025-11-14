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
            $mainImgUrl = $firstImg
                ? $firstImg->getUrl()
                : 'https://via.placeholder.com/1200x400?text=' . urlencode($negocio->nombre_negocio);
        @endphp

        <div class="mb-4">
            <img src="{{ $mainImgUrl }}" alt="{{ $negocio->nombre_negocio }}" class="w-100 rounded shadow-sm"
                style="max-height:400px; object-fit:cover;" id="mainBusinessImage">
        </div>

        {{-- Galería de miniaturas debajo de la imagen principal --}}
        @if($negocio->imagenes->count() > 0)
            <div class="row g-2 mb-4" id="thumbnailGallery">
                @foreach($negocio->imagenes as $index => $img)
                    <div class="col-3 col-md-2">
                        <a href="#" class="thumbnail-link d-block {{ $index == 0 ? 'active' : '' }}" data-full-image="{{ $img->getUrl() }}">
                            <img src="{{ $img->getUrl() }}" alt="Miniatura de {{ $negocio->nombre_negocio }}" class="img-fluid rounded shadow-sm" style="object-fit:cover; height:80px; width:100%; border: 2px solid transparent;">
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

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

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
                            @if ($negocio->facebook_url)
                                <li><strong>Facebook:</strong> <a href="{{ $negocio->facebook_url }}" target="_blank">Visitar</a></li>
                            @endif
                            @if ($negocio->instagram_url)
                                <li><strong>Instagram:</strong> <a href="{{ $negocio->instagram_url }}" target="_blank">Visitar</a></li>
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
                                    <div>
                                        <h6 class="fw-bold">{{ $p->nombre_producto }}</h6>
                                        <p class="small text-muted mb-2">{{ Str::limit($p->descripcion, 60) }}</p>
                                    </div>
                                    <div>
                                        <span class="fw-bold text-dark d-block mb-2">₡{{ number_format($p->precio, 2) }}</span>
                                        <a href="{{ route('productos.show', $p->id_producto) }}" class="btn btn-sm btn-primary">Ver Producto</a>
                                    </div>
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
                            <a href="{{ $img->getUrl() }}" class="glightbox" data-gallery="negocio-gallery">
                                <img src="{{ $img->getUrl() }}" alt="Imagen de la galería de {{ $negocio->nombre_negocio }}" class="img-fluid rounded shadow-sm"
                                    style="object-fit:cover; height:200px; width:100%;">
                            </a>
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
                <div class="row mt-3">
                    <div class="col-md-8">
                        <h5 class="fw-bold mb-3">Envíanos un mensaje</h5>
                        <form action="{{ route('negocios.contact', $negocio->id_negocio) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre_interesado" class="form-label">Tu Nombre</label>
                                <input type="text" name="nombre_interesado" id="nombre_interesado" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono_interesado" class="form-label">Tu Teléfono</label>
                                <input type="tel" name="telefono_interesado" id="telefono_interesado" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo_interesado" class="form-label">Tu Correo Electrónico</label>
                                <input type="email" name="correo_interesado" id="correo_interesado" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Mensaje</label>
                                <textarea name="mensaje" id="mensaje" class="form-control" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <h5 class="fw-bold mb-3">Nuestra Información</h5>
                        <ul class="list-unstyled">
                            @if ($negocio->telefono)
                                <li><strong>Teléfono:</strong> {{ $negocio->telefono }}</li>
                            @endif
                            @if ($negocio->email)
                                <li><strong>Email:</strong> <a href="mailto:{{ $negocio->email }}">{{ $negocio->email }}</a></li>
                            @endif
                            @if ($negocio->facebook_url)
                                <li><strong>Facebook:</strong> <a href="{{ $negocio->facebook_url }}" target="_blank">Visitar</a></li>
                            @endif
                            @if ($negocio->instagram_url)
                                <li><strong>Instagram:</strong> <a href="{{ $negocio->instagram_url }}" target="_blank">Visitar</a></li>
                            @endif
                        </ul>
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

    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainBusinessImage');
        const thumbnails = document.querySelectorAll('#thumbnailGallery .thumbnail-link');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function(e) {
                e.preventDefault(); // Evitar que el enlace navegue

                // Actualizar la imagen principal
                mainImage.src = this.dataset.fullImage;

                // Remover la clase 'active' de todas las miniaturas
                thumbnails.forEach(t => t.classList.remove('active'));
                thumbnails.forEach(t => t.querySelector('img').style.borderColor = 'transparent');


                // Añadir la clase 'active' a la miniatura clicada
                this.classList.add('active');
                this.querySelector('img').style.borderColor = '#007bff'; // Color del borde activo
            });
        });

        // Inicializar el borde de la primera imagen activa
        const firstActiveThumbnail = document.querySelector('#thumbnailGallery .thumbnail-link.active');
        if (firstActiveThumbnail) {
            firstActiveThumbnail.querySelector('img').style.borderColor = '#007bff';
        }
    });
</script>
@endpush
