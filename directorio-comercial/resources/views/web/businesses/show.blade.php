@extends('web.layouts.app')

@section('title', $business->name . ' - Directorio Comercial')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Información Principal del Comercio -->
        <div class="col-md-8">
            @if($business->featured_image)
                <img src="{{ asset('storage/' . $business->featured_image) }}" 
                     class="img-fluid rounded mb-4" 
                     alt="{{ $business->name }}"
                     style="height: 400px; width: 100%; object-fit: cover;">
            @endif

            <h1>{{ $business->name }}</h1>
            
            <div class="mb-3">
                @foreach($business->categories as $category)
                    <span class="badge bg-primary me-1">{{ $category->name }}</span>
                @endforeach
            </div>

            <p class="lead">{{ $business->description }}</p>

            <!-- Productos del Comercio -->
            @if($business->products->count() > 0)
                <h3 class="mt-5 mb-4">Productos y Servicios</h3>
                <div class="row g-3">
                    @foreach($business->products as $product)
                        <div class="col-md-6">
                            <div class="card">
                                @if($product->featured_image)
                                    <img src="{{ asset('storage/' . $product->featured_image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->name }}"
                                         style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                    @if($product->price)
                                        <p class="card-text">
                                            <strong class="text-success">${{ number_format($product->price, 2) }}</strong>
                                        </p>
                                    @endif
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">
                                        Ver Detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Información de Contacto -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Información de Contacto</h5>
                </div>
                <div class="card-body">
                    @if($business->address)
                        <div class="mb-3">
                            <h6><i class="bi bi-geo-alt"></i> Dirección</h6>
                            <p class="text-muted">{{ $business->address }}</p>
                        </div>
                    @endif

                    @if($business->phones)
                        <div class="mb-3">
                            <h6><i class="bi bi-telephone"></i> Teléfonos</h6>
                            <p class="text-muted">{{ $business->phones }}</p>
                        </div>
                    @endif

                    @if($business->emails)
                        <div class="mb-3">
                            <h6><i class="bi bi-envelope"></i> Correos</h6>
                            <p class="text-muted">{{ $business->emails }}</p>
                        </div>
                    @endif

                    @if($business->facebook || $business->instagram)
                        <div class="mb-3">
                            <h6><i class="bi bi-share"></i> Redes Sociales</h6>
                            @if($business->facebook)
                                <a href="{{ $business->facebook }}" target="_blank" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="bi bi-facebook"></i> Facebook
                                </a>
                            @endif
                            @if($business->instagram)
                                <a href="{{ $business->instagram }}" target="_blank" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-instagram"></i> Instagram
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Formulario de Contacto -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">Enviar Mensaje</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.send', $business->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection