@extends('admin.layout')

@section('title','Editar categoría')

@section('content')
  <h1>Editar categoría</h1>
  <form action="{{ route('admin.categorias.update', $categoria->id_categoria_negocio) }}" method="POST" enctype="multipart/form-data">
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
    <div class="mb-3">
        <label for="categoria_negocio_imagen_url" class="form-label">Imagen de Categoría</label>
        @if ($categoria->categoria_negocio_imagen_url)
            @php
                $img = $categoria->categoria_negocio_imagen_url;
                if ($img && !Str::startsWith($img, ['http://', 'https://'])) {
                    $img = asset('storage/' . $img);
                }
            @endphp
            <div class="mb-2">
                <img src="{{ $img }}" alt="Imagen actual" style="max-width: 200px; height: auto;">
            </div>
        @endif
        <input class="form-control" type="file" id="categoria_negocio_imagen_url" name="categoria_negocio_imagen_url">
    </div>
    <button class="btn btn-primary">Guardar</button>
  </form>
@endsection
