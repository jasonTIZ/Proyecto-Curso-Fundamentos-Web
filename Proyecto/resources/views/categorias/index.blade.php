@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
    <div class="container py-5">
        <div class="row">
            {{-- Sidebar de Categorías --}}
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Categorías</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center {{ !$categoriaSeleccionada ? 'active' : '' }}">
                        <a href="{{ route('categorias.index') }}" class="{{ !$categoriaSeleccionada ? 'text-white' : 'text-dark' }}" style="text-decoration:none;">
                            Todas las categorías
                        </a>
                        <span class="badge bg-secondary">{{ $categorias->sum('negocios_count') }}</span>
                    </li>
                    @foreach ($categorias as $c)
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center {{ isset($categoriaSeleccionada) && $categoriaSeleccionada->id_categoria_negocio == $c->id_categoria_negocio ? 'active' : '' }}">
                            <a href="{{ route('categorias.show', $c->id_categoria_negocio) }}"
                                class="{{ isset($categoriaSeleccionada) && $categoriaSeleccionada->id_categoria_negocio == $c->id_categoria_negocio ? 'text-white' : 'text-dark' }}"
                                style="text-decoration:none;">
                                {{ $c->nombre_categoria }}
                            </a>
                            <span class="badge bg-secondary">{{ $c->negocios_count }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contenido principal --}}
            <div class="col-md-9">
                <h2 class="fw-bold mb-4">{{ $titulo }}</h2>
                <div class="row gy-4">
                    @forelse($negocios as $n)
                        @php
                            $firstImg = $n->imagenes->first();
                            $img = $firstImg
                                ? $firstImg->getUrl()
                                : 'https://via.placeholder.com/800x450?text=' . urlencode($n->nombre_negocio);
                        @endphp
                        <div class="col-sm-6 col-md-4">
                            <article class="card-business h-100">
                                <div class="card-img-wrap position-relative">
                                    <img src="{{ $img }}" alt="{{ $n->nombre_negocio }}" class="card-img-top"
                                        style="height:200px;object-fit:cover;">
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between text-center">
                                    <h5 class="mb-3 fw-bold">{{ $n->nombre_negocio }}</h5>
                                    <a href="{{ route('negocios.show', $n->id_negocio) }}"
                                        class="btn btn-accent btn-sm">Ver más</a>
                                </div>
                            </article>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-muted text-center">No hay comercios disponibles.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
