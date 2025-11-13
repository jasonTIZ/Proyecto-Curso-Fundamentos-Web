@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="container">
        @if (isset($slides) && $slides->isNotEmpty())
            <div id="homeCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($slides as $i => $n)
                        <button type="button" data-bs-target="#homeCarousel" data-bs-slide-to="{{ $i }}"
                            class="{{ $i == 0 ? 'active' : '' }}" aria-current="{{ $i == 0 ? 'true' : '' }}"
                            aria-label="Slide {{ $i + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($slides as $i => $n)
                        @php
                            $firstImg = $n->imagenes->first();
                            $img = $firstImg ? $firstImg->getUrl() : null;
                        @endphp
                        <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                            <a href="{{ route('negocios.show', $n->id_negocio) }}">
                                <img src="{{ $img ?: 'https://via.placeholder.com/1200x420?text=' . urlencode($n->nombre_negocio) }}"
                                    class="d-block w-100" style="max-height:420px;object-fit:cover;"
                                    alt="{{ $n->nombre_negocio }}">
                            </a>
                            @if ($n->nombre_negocio || $n->descripcion)
                                <div class="carousel-caption d-none d-md-block text-start">
                                    @if ($n->nombre_negocio)
                                        <h5>{{ $n->nombre_negocio }}</h5>
                                    @endif
                                    @if ($n->descripcion)
                                        <p>{{ Str::limit($n->descripcion, 120) }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        @endif
        <div class="row gy-4">
            @forelse($negocios as $n)
                @php
                    $firstImg = $n->imagenes->first();
                    $img = $firstImg ? $firstImg->getUrl() : null;
                @endphp
                <div class="col-sm-6 col-md-4">
                    <article class="card-business h-100">
                        <div class="card-img-wrap position-relative">
                            <img src="{{ $img ?: 'https://via.placeholder.com/800x450?text=' . urlencode($n->nombre_negocio) }}"
                                alt="{{ $n->nombre_negocio }}" class="card-img-top">
                            <div class="card-overlay p-3 d-flex flex-column justify-content-end">
                                <h5 class="mb-1 text-white">{{ $n->nombre_negocio }}</h5>
                                <p class="small text-white-50 mb-2">{{ Str::limit($n->descripcion, 90) }}</p>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                @if ($n->categorias)
                                    @foreach ($n->categorias->take(3) as $c)
                                        <span class="badge bg-light text-muted me-1">{{ $c->nombre_categoria }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('negocios.show', $n->id_negocio) }}"
                                    class="btn btn-accent btn-sm">Ver</a>
                                <small class="text-muted">{{ $n->productos->count() }} productos</small>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No hay negocios aún.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            @if (method_exists($negocios, 'links'))
                {!! $negocios->links() !!}
            @endif
        </div>
    </div>
@endsection

@section('categories-content')
    <div class="categories-container">
        <div class="container">
            <h1>Categorías</h1>
        </div>
    </div>
    <div class="container my-5">
        <h3 class="mb-4 text-center">Categorías de Negocios</h3>
        <div class="row gy-4">
            @forelse($categorias as $c)
                @php
                    $img =
                        $c->imagen_url ?? 'https://via.placeholder.com/800x450?text=' . urlencode($c->nombre_categoria);
                @endphp

                <div class="col-sm-6 col-md-4 col-lg-3">
                    <article class="card-business h-100">
                        <div class="card-img-wrap position-relative">
                            <img src="{{ $img }}" alt="{{ $c->nombre_categoria }}" class="card-img-top"
                                style="object-fit:cover; height:200px;">
                            <div class="card-overlay p-3 d-flex flex-column justify-content-end">
                                <h5 class="mb-1 text-white">{{ $c->nombre_categoria }}</h5>
                                @if ($c->descripcion)
                                    <p class="small text-white-50 mb-0">{{ Str::limit($c->descripcion, 90) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="mt-auto text-center">
                                {{-- Enlace corregido --}}
                                <a href="{{ route('categorias.show', $c->id_categoria_negocio) }}"
                                    class="btn btn-accent btn-sm">Ver</a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No hay categorías disponibles.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
