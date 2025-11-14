@extends('admin.layout')

@section('title','Crear categoría')

@section('content')
  <h1>Crear categoría</h1>
  <form action="{{ route('admin.categorias.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre_categoria" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label for="categoria_negocio_imagen_url" class="form-label">Imagen de Categoría</label>
        <input class="form-control" type="file" id="categoria_negocio_imagen_url" name="categoria_negocio_imagen_url">
    </div>
    <button class="btn btn-primary">Guardar</button>
  </form>
@endsection
