@extends('web.layouts.app')

@section('title', 'Inicio - Directorio Comercial')

@section('content')
<!-- Slider -->
<div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($slides as $index => $slide)
            <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($slides as $index => $slide)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . $slide->image) }}" class="d-block w-100" alt="{{ $slide->title }}" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block" style="background: rgba(0,0,0,0.5); padding: 2rem; border-radius: 15px;">
                    <h2>{{ $slide->title }}</h2>
                    <p>{{ $slide->description }}</p>
                    @if($slide->link)
                        <a href="{{ $slide->link }}" class="btn btn-primary">Ver Más</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Search Section -->
<div class="search-section">
    <div class="container">
        <h2 class="text-center mb-4">Encuentra lo que Buscas</h2>
        <form action="{{ route('search') }}" method="GET" class="search-box">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar comercios o productos..." required>
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Recent Businesses -->
<div class="container my-5">
    <h2 class="section-title">Comercios Recientes</h2>
    <div class="row g-4">
        @foreach($recentBusinesses as $business)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $business->featured_image) }}" class="card-img-top" alt="{{ $business->name }}">
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

<!-- Categories -->
<div class="container my-5">
    <h2 class="section-title">Categorías</h2>
    <div class="row g-4">
        @foreach($categories as $category)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top" alt="{{ $category->name }}">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="text-muted">{{ $category->businesses_count }} comercios</p>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">
                            Explorar
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection