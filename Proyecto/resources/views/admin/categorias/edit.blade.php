@extends('admin.layout')

@section('title','Editar categoría')

@section('content')
  <h1>Editar categoría</h1>
  <form action="{{ route('admin.categorias.update', $categoria->id_categoria_negocio) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre_categoria" value="{{ $categoria->nombre_categoria }}" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
    </div>
    <button class="btn btn-primary">Guardar</button>
  </form>
@endsection
