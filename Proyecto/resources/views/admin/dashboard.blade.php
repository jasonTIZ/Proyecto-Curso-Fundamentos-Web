@extends('admin.layout')

@section('title','Dashboard')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="mb-0">Panel administrativo</h1>
      <small class="text-muted">Resumen rápido de la aplicación</small>
    </div>
    <div>
      <a href="{{ route('admin.negocios.create') }}" class="btn btn-primary">+ Nuevo negocio</a>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-md-4">
      <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-0">Negocios</h5>
            <small class="text-muted">Total registrados</small>
          </div>
          <div class="display-6">{{ $totalNegocios ?? 0 }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-0">Categorías</h5>
            <small class="text-muted">Categorías activas</small>
          </div>
          <div class="display-6">{{ $totalCategorias ?? 0 }}</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h5 class="mb-0">Productos</h5>
            <small class="text-muted">Productos totales</small>
          </div>
          <div class="display-6">{{ $totalProductos ?? 0 }}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Listado de negocios</h5>

      @if(isset($negocios) && count($negocios))
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th></th>
                <th>Nombre</th>
                <th>Categorías</th>
                <th>Creado</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($negocios as $n)
                <tr>
                  <td style="width:90px;">
                    @php $first = $n->imagenes->first() ?? null; @endphp
                    @if($first)
                      <img src="{{ $first->getUrl() }}" style="width:72px; height:48px; object-fit:cover; border-radius:6px;" alt="">
                    @else
                      <div style="width:72px; height:48px; background:#f1f1f1; border-radius:6px;"></div>
                    @endif
                  </td>
                  <td>{{ $n->nombre_negocio }}</td>
                  <td>
                    @if($n->categorias && $n->categorias->count())
                      @foreach($n->categorias as $c)
                        <span class="badge bg-secondary">{{ $c->nombre_categoria }}</span>
                      @endforeach
                    @else
                      <span class="text-muted">—</span>
                    @endif
                  </td>
                  <td>{{ optional($n->created_at)->format('Y-m-d') ?? '—' }}</td>
                  <td style="width:160px;">
                    <a href="{{ route('admin.negocios.edit', $n->id_negocio) }}" class="btn btn-sm btn-primary me-1">Editar</a>
                    <a href="{{ route('negocios.show', $n->id_negocio) }}" class="btn btn-sm btn-success me-1" target="_blank">Ver</a>
                    <form action="{{ route('admin.negocios.destroy', $n->id_negocio) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Eliminar negocio?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <p class="text-muted">No hay negocios aún. Usa el botón "Nuevo negocio" para agregar uno.</p>
      @endif
    </div>
  </div>
@endsection
