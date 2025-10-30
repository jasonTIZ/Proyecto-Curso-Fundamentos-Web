@extends('admin.layout')

@section('title','Crear categoría')

@section('content')
  <h1>Crear categoría</h1>
  <form action="{{ route('admin.categorias.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre_categoria" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary">Guardar</button>
  </form>
@endsection
