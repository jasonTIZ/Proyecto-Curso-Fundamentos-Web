@extends('admin.layout')

@section('title','Crear negocio')

@section('content')
  <h1>Crear negocio</h1>
  <form action="{{ route('admin.negocios.store') }}" method="POST" enctype="multipart/form-data" class="ajax-upload-form">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre_negocio" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Descripcion</label>
      <textarea name="descripcion" class="form-control"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Imágenes (puedes subir varias)</label>
      <div class="upload-dropzone mb-2">Arrastra imágenes aquí o haz clic para seleccionar</div>
      <input type="file" name="images[]" class="form-control" multiple accept="image/*" style="display:none;">
      <div class="upload-progress-wrap mb-2">
        <div class="progress" style="height:6px"><div class="progress-bar" style="width:0%"></div></div>
      </div>
      <div id="preview" class="d-flex flex-wrap gap-2"></div>
    </div>
    <button class="btn btn-primary">Guardar</button>
  </form>
    @include('admin._upload-enhancements')
@endsection
