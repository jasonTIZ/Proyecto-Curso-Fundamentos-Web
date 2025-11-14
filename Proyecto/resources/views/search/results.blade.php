@extends('layouts.app')

@section('title', 'Resultados de búsqueda')

@section('content')
<div class="container">
  <h2>Resultados para: "{{ $q }}"</h2>

  <div class="row">
    <div class="col-md-6">
      <h4>Negocios ({{ $negocios->count() }})</h4>
      @forelse($negocios as $n)
        @php $img = $n->imagenes->first()?->getUrl(); @endphp
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-4">
              <img src="{{ $img ?: 'https://via.placeholder.com/300x200?text=' . urlencode($n->nombre_negocio) }}" class="img-fluid rounded-start">
            </div>
            <div class="col-8">
              <div class="card-body">
                <h5 class="card-title">{{ $n->nombre_negocio }}</h5>
                <p class="card-text small">{{ Str::limit($n->descripcion,120) }}</p>
                <a href="{{ route('negocios.show', $n->id_negocio) }}" class="btn btn-sm btn-primary">Ver negocio</a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <p class="text-muted">No se encontraron negocios.</p>
      @endforelse
    </div>

    <div class="col-md-6">
      <h4>Productos ({{ $productos->count() }})</h4>
      @forelse($productos as $p)
        @php $img = $p->imagenes->first()?->getUrl(); @endphp
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-4">
              <img src="{{ $img ?: 'https://via.placeholder.com/300x200?text=' . urlencode($p->nombre_producto) }}" class="img-fluid rounded-start" alt="{{ $p->nombre_producto }}">
            </div>
            <div class="col-8">
              <div class="card-body">
                <h5 class="card-title">{{ $p->nombre_producto }}</h5>
                <p class="card-text small">{{ Str::limit($p->descripcion,120) }}</p>
                <p class="mb-1"><strong>Negocio:</strong> <a href="{{ route('negocios.show', $p->negocio->id_negocio ?? '#') }}">{{ $p->negocio->nombre_negocio ?? '—' }}</a></p>
                <p class="mb-1"><strong>Precio:</strong> ₡{{ number_format($p->precio,2) }}</p>
                <a href="{{ route('productos.show', $p->id_producto) }}" class="btn btn-sm btn-primary">Ver producto</a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <p class="text-muted">No se encontraron productos.</p>
      @endforelse
    </div>
  </div>
</div>
@endsection
