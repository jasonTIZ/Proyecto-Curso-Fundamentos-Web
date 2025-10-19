@extends('web.layouts.app')

@section('title', $product->name . ' - Directorio Comercial')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            @if($product->featured_image)
                <img src="{{ asset('storage/' . $product->featured_image) }}" 
                     class="img-fluid rounded mb-4" 
                     alt="{{ $product->name }}"
                     style="height: 400px; width: 100%; object-fit: cover;">
            @endif

            <h1>{{ $product->name }}</h1>
            
            @if($product->price)
                <h2 class="text-success mb-3">${{ number_format($product->price, 2) }}</h2>
            @endif

            <p class="lead">{{ $product->description }}</p>

            <!-- Galería de Imágenes -->
            @if($product->gallery && $product->gallery->count() > 0)
                <h3 class="mt-5 mb-3">Galería de Imágenes</h3>
                <div class="row g-3">
                    @foreach($product->gallery as $image)
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $image->image) }}" 
                                 class="img-fluid rounded" 
                                 alt="{{ $image->caption }}"
                                 style="height: 200px; width: 100%; object-fit: cover;">
                            @if($image->caption)
                                <p class="text-center mt-2 text-muted">{{ $image->caption }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Información del Comercio</h5>
                </div>
                <div class="card-body">
                    <h6>{{ $product->business->name }}</h6>
                    <p class="text-muted">{{ Str::limit($product->business->description, 100) }}</p>
                    
                    @if($product->business->address)
                        <p><i class="bi bi-geo-alt"></i> {{ $product->business->address }}</p>
                    @endif
                    
                    @if($product->business->phones)
                        <p><i class="bi bi-telephone"></i> {{ $product->business->phones }}</p>
                    @endif

                    <a href="{{ route('businesses.show', $product->business->id) }}" class="btn btn-primary w-100">
                        Ver Comercio Completo
                    </a>
                </div>
            </div>

            <!-- Otros Productos del Mismo Comercio -->
            @if($product->business->products->where('id', '!=', $product->id)->count() > 0)
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Otros Productos</h5>
                    </div>
                    <div class="card-body">
                        @foreach($product->business->products->where('id', '!=', $product->id)->take(3) as $otherProduct)
                            <div class="d-flex mb-3">
                                @if($otherProduct->featured_image)
                                    <img src="{{ asset('storage/' . $otherProduct->featured_image) }}" 
                                         alt="{{ $otherProduct->name }}"
                                         style="width: 60px; height: 60px; object-fit: cover;"
                                         class="rounded me-3">
                                @endif
                                <div>
                                    <h6 class="mb-1">{{ $otherProduct->name }}</h6>
                                    @if($otherProduct->price)
                                        <small class="text-success">${{ number_format($otherProduct->price, 2) }}</small>
                                    @endif
                                    <br>
                                    <a href="{{ route('products.show', $otherProduct->id) }}" class="btn btn-sm btn-outline-primary">
                                        Ver
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection