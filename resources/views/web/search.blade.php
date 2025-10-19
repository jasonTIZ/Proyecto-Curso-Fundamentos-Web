@extends('web.layouts.app')

@section('title', 'Resultados de Búsqueda - Directorio Comercial')

@section('content')
<div class="container my-5">
    <h1>Resultados de búsqueda para: "{{ $query }}"</h1>
    
    @if($businesses->count() > 0 || $products->count() > 0)
        <!-- Comercios -->
        @if($businesses->count() > 0)
            <div class="mt-4">
                <h3>Comercios ({{ $businesses->count() }})</h3>
                <div class="row g-4">
                    @foreach($businesses as $business)
                        <div class="col-md-6">
                            <div class="card">
                                @if($business->featured_image)
                                    <img src="{{ asset('storage/' . $business->featured_image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $business->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $business->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($business->description, 100) }}</p>
                                    <a href="{{ route('businesses.show', $business->id) }}" class="btn btn-primary">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Productos -->
        @if($products->count() > 0)
            <div class="mt-5">
                <h3>Productos ({{ $products->count() }})</h3>
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-4">
                            <div class="card">
                                @if($product->featured_image)
                                    <img src="{{ asset('storage/' . $product->featured_image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                                    <p class="card-text">
                                        <strong>${{ number_format($product->price, 2) }}</strong>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">En: {{ $product->business->name }}</small>
                                    </p>
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">
                                        Ver Producto
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="bi bi-search display-1 text-muted"></i>
            <h4 class="mt-3">No se encontraron resultados</h4>
            <p class="text-muted">Intenta con otros términos de búsqueda</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Volver al inicio</a>
        </div>
    @endif
</div>
@endsection