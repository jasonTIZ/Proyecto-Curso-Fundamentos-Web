@extends('web.layouts.app')

@section('title', 'Categorías - Directorio Comercial')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5">
        @if($selectedCategory)
            {{ $selectedCategory->name }}
        @else
            Todas las Categorías
        @endif
    </h1>

    <div class="row">
        <!-- Sidebar de Categorías -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Categorías</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('categories.index') }}" 
                       class="list-group-item list-group-item-action {{ !$selectedCategory ? 'active' : '' }}">
                        Todas las categorías
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category->id) }}" 
                           class="list-group-item list-group-item-action {{ $selectedCategory && $selectedCategory->id == $category->id ? 'active' : '' }}">
                            {{ $category->name }}
                            <span class="badge bg-secondary float-end">{{ $category->businesses_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Contenido Principal -->
        <div class="col-md-9">
            @if($businesses->count() > 0)
                <div class="row g-4">
                    @foreach($businesses as $business)
                        <div class="col-md-6">
                            <div class="card h-100">
                                @if($business->featured_image)
                                    <img src="{{ asset('storage/' . $business->featured_image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $business->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $business->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($business->description, 100) }}</p>
                                    <div class="mb-2">
                                        @foreach($business->categories as $category)
                                            <span class="badge bg-primary me-1">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="bi bi-geo-alt"></i> {{ $business->address }}
                                        </small>
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <a href="{{ route('businesses.show', $business->id) }}" class="btn btn-primary w-100">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-shop display-1 text-muted"></i>
                    <h4 class="mt-3">No se encontraron comercios</h4>
                    <p class="text-muted">
                        @if($selectedCategory)
                            No hay comercios en la categoría "{{ $selectedCategory->name }}"
                        @else
                            No hay comercios registrados
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection