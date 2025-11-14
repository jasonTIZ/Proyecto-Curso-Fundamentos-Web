@extends('admin.layout')

@section('title','Crear negocio')

@section('content')
  <h1>Crear negocio</h1>
  <form action="{{ route('admin.negocios.store') }}" method="POST" enctype="multipart/form-data" class="ajax-upload-form">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre_negocio" class="form-control" value="{{ old('nombre_negocio') }}">
    </div>

    <div class="row">
        <div class="col-md-6">
            <fieldset class="border p-3 mb-3">
                <legend class="w-auto h6">Dirección</legend>
                <div class="mb-3"><label class="form-label">Provincia</label><input name="provincia" value="{{ old('provincia') }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Cantón</label><input name="canton" value="{{ old('canton') }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Distrito</label><input name="distrito" value="{{ old('distrito') }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Barrio</label><input name="barrio" value="{{ old('barrio') }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Otras Señas</label><textarea name="otras_senas" class="form-control">{{ old('otras_senas') }}</textarea></div>
            </fieldset>
        </div>
        <div class="col-md-6">
            <fieldset class="border p-3 mb-3">
                <legend class="w-auto h6">Contacto y Redes</legend>
                <div class="mb-3"><label class="form-label">Teléfono</label><input name="telefono" value="{{ old('telefono') }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email') }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Facebook URL</label><input type="url" name="facebook_url" value="{{ old('facebook_url') }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Instagram URL</label><input type="url" name="instagram_url" value="{{ old('instagram_url') }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">TikTok URL</label><input type="url" name="tiktok_url" value="{{ old('tiktok_url') }}" class="form-control"></div>
            </fieldset>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Ubicación (Google Maps Iframe)</label>
        <textarea name="iframe_ubicacion" class="form-control" rows="3">{{ old('iframe_ubicacion') }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Descripcion</label>
      <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Categorías</label>
        <div class="border p-2 rounded" style="max-height: 200px; overflow-y: auto;">
            @forelse($categorias as $categoria)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categorias[]" value="{{ $categoria->id_categoria_negocio }}" id="cat-{{ $categoria->id_categoria_negocio }}">
                    <label class="form-check-label" for="cat-{{ $categoria->id_categoria_negocio }}">
                        {{ $categoria->nombre_categoria }}
                    </label>
                </div>
            @empty
                <p class="text-muted">No hay categorías para seleccionar. Por favor, crea una primero.</p>
            @endforelse
        </div>
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
