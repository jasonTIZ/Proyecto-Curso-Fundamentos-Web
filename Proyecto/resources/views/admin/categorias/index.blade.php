@extends('admin.layout')

@section('title','Categorías')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Categorías</h1>
    <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">Crear nueva</a>
  </div>
  <table class="table table-striped">
    <thead><tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr></thead>
    <tbody>
      @foreach($categorias as $c)
        <tr>
          <td>{{ $c->id_categoria_negocio }}</td>
          <td>{{ $c->nombre_categoria }}</td>
          <td>
            <a href="{{ route('admin.categorias.edit', $c->id_categoria_negocio) }}" class="btn btn-sm btn-secondary">Editar</a>
            <form action="{{ route('admin.categorias.destroy', $c->id_categoria_negocio) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Eliminar?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger">Eliminar</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $categorias->links() }}
@endsection
