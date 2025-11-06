@extends('admin.layout')

@section('title','Negocios')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Negocios</h1>
    <a href="{{ route('admin.negocios.create') }}" class="btn btn-primary">Crear nuevo</a>
  </div>
  <table class="table table-striped">
    <thead><tr><th></th><th>ID</th><th>Nombre</th><th>Acciones</th></tr></thead>
    <tbody>
      @foreach($negocios as $n)
        <tr>
          @php $firstImg = $n->imagenes->first(); $thumb = $firstImg ? $firstImg->getUrl() : null; @endphp
          <td style="width:100px"><img src="{{ $thumb ?: 'https://via.placeholder.com/120x80?text=No+Image' }}" class="img-fluid rounded" alt="" style="max-height:60px"></td>
          <td>{{ $n->id_negocio }}</td>
          <td>{{ $n->nombre_negocio }}</td>
          <td>
            <a href="{{ route('admin.negocios.edit', $n->id_negocio) }}" class="btn btn-sm btn-secondary">Editar</a>
            <form action="{{ route('admin.negocios.destroy', $n->id_negocio) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Eliminar?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">Eliminar</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $negocios->links() }}
@endsection
