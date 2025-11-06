@extends('layouts.app')

@section('title', $negocio->nombre_negocio)

@section('content')
  <div class="container py-4">
    <div class="row mb-4 align-items-center">
      <div class="col-md-8">
        <h1 class="display-5">{{ $negocio->nombre_negocio }}</h1>
        <p class="lead text-muted">{{ $negocio->descripcion }}</p>
      </div>
      <div class="col-md-4 text-md-end">
        @php $first = $negocio->imagenes->first() ?? null; @endphp
        @if($first)
          <img src="{{ $first->getUrl() }}" alt="{{ $negocio->nombre_negocio }}" style="max-width:220px; border-radius:8px; object-fit:cover;" class="img-fluid shadow-sm">
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8">
        <div class="card mb-4 shadow-sm">
          <div class="card-body">
            <h4 class="card-title">Descripción</h4>
            <p class="card-text">{{ $negocio->descripcion }}</p>

            <h5 class="mt-4">Productos</h5>
            @if($negocio->productos && $negocio->productos->count())
              <ul class="list-group list-group-flush">
                @foreach($negocio->productos as $p)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                      <a href="{{ route('productos.show', $p->id_producto) }}">{{ $p->nombre_producto }}</a>
                      <div class="text-muted small">{{ $p->descripcion ?? '' }}</div>
                    </div>
                    <div class="fw-bold">₡{{ number_format($p->precio,0,',','.') }}</div>
                  </li>
                @endforeach
              </ul>
            @else
              <p class="text-muted">No hay productos registrados.</p>
            @endif

            <h5 class="mt-4">Galería</h5>
            <div class="row g-2">
              @foreach($negocio->imagenes as $img)
                <div class="col-6 col-sm-4 col-md-3">
                  <a href="#" class="d-block gallery-thumb" data-src="{{ $img->getUrl() }}">
                    <img src="{{ $img->getUrl() }}" class="img-fluid rounded" style="height:120px; object-fit:cover; width:100%;" alt="">
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card mb-3 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Información</h5>
            <dl class="row">
             

              <dt class="col-4">Teléfono</dt>
              <dd class="col-8">{{ $negocio->telefono ?? '—' }}</dd>

              <dt class="col-4">Email</dt>
              <dd class="col-8">{{ $negocio->email ?? '—' }}</dd>

              <dt class="col-4">Provincia</dt>
              <dd class="col-8">{{ $negocio->provincia ?? '—' }}</dd>

              <dt class="col-4">Cantón</dt>
              <dd class="col-8">{{ $negocio->canton ?? '—' }}</dd>

              <dt class="col-4">Distrito</dt>
              <dd class="col-8">{{ $negocio->distrito ?? '—' }}</dd>

              <dt class="col-4">Barrio</dt>
              <dd class="col-8">{{ $negocio->barrio ?? '—' }}</dd>

              <dt class="col-4">Otras señas</dt>
              <dd class="col-8">{!! nl2br(e($negocio->otras_senas ?? '—')) !!}</dd>
            </dl>

            @if($negocio->facebook_url || $negocio->instagram_url || $negocio->tiktok_url)
              <div class="mt-2">
                @if($negocio->facebook_url)
                  <a href="{{ $negocio->facebook_url }}" target="_blank" class="btn btn-sm btn-outline-primary me-1">Facebook</a>
                @endif
                @if($negocio->instagram_url)
                  <a href="{{ $negocio->instagram_url }}" target="_blank" class="btn btn-sm btn-outline-danger me-1">Instagram</a>
                @endif
                @if($negocio->tiktok_url)
                  <a href="{{ $negocio->tiktok_url }}" target="_blank" class="btn btn-sm btn-outline-dark">TikTok</a>
                @endif
              </div>
            @endif
          </div>
        </div>

        @if($negocio->iframe_ubicacion)
          <div class="card mb-3 shadow-sm">
            <div class="card-body">
              <h6 class="card-title">Ubicación</h6>
              <div class="ratio ratio-4x3">{!! $negocio->iframe_ubicacion !!}</div>
            </div>
          </div>
        @endif

      </div>
    </div>

    <!-- Modal for gallery preview -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-body p-0">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <img src="" id="galleryModalImg" style="width:100%; height:auto; display:block;" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function(){
      const thumbs = document.querySelectorAll('.gallery-thumb');
      const modalImg = document.getElementById('galleryModalImg');
      const galleryModal = new bootstrap.Modal(document.getElementById('galleryModal'));
      thumbs.forEach(a => {
        a.addEventListener('click', function(e){
          e.preventDefault();
          const src = this.getAttribute('data-src');
          modalImg.src = src;
          galleryModal.show();
        });
      });
    })();
  </script>
@endsection
