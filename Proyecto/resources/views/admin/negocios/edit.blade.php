@extends('admin.layout')

@section('title','Editar negocio')

@section('content')
  <h1>Editar negocio</h1>
  <form action="{{ route('admin.negocios.update', $negocio->id_negocio) }}" method="POST" enctype="multipart/form-data" class="ajax-upload-form">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre_negocio" value="{{ old('nombre_negocio', $negocio->nombre_negocio) }}" class="form-control">
    </div>

    <div class="row">
        <div class="col-md-6">
            <fieldset class="border p-3 mb-3">
                <legend class="w-auto h6">Dirección</legend>
                <div class="mb-3"><label class="form-label">Provincia</label><input name="provincia" value="{{ old('provincia', $negocio->provincia) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Cantón</label><input name="canton" value="{{ old('canton', $negocio->canton) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Distrito</label><input name="distrito" value="{{ old('distrito', $negocio->distrito) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Barrio</label><input name="barrio" value="{{ old('barrio', $negocio->barrio) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Otras Señas</label><textarea name="otras_senas" class="form-control">{{ old('otras_senas', $negocio->otras_senas) }}</textarea></div>
            </fieldset>
        </div>
        <div class="col-md-6">
            <fieldset class="border p-3 mb-3">
                <legend class="w-auto h6">Contacto y Redes</legend>
                <div class="mb-3"><label class="form-label">Teléfono</label><input name="telefono" value="{{ old('telefono', $negocio->telefono) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email', $negocio->email) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Facebook URL</label><input type="url" name="facebook_url" value="{{ old('facebook_url', $negocio->facebook_url) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Instagram URL</label><input type="url" name="instagram_url" value="{{ old('instagram_url', $negocio->instagram_url) }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">TikTok URL</label><input type="url" name="tiktok_url" value="{{ old('tiktok_url', $negocio->tiktok_url) }}" class="form-control"></div>
            </fieldset>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Ubicación (Google Maps Iframe)</label>
        <textarea name="iframe_ubicacion" class="form-control" rows="3">{{ old('iframe_ubicacion', $negocio->iframe_ubicacion) }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Descripcion</label>
      <textarea name="descripcion" class="form-control">{{ old('descripcion', $negocio->descripcion) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Categorías</label>
        <div class="border p-2 rounded" style="max-height: 200px; overflow-y: auto;">
            @php
                $currentCategorias = $negocio->categorias->pluck('id_categoria_negocio')->toArray();
            @endphp
            @forelse($categorias as $categoria)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categorias[]" value="{{ $categoria->id_categoria_negocio }}" id="cat-{{ $categoria->id_categoria_negocio }}"
                        @if(in_array($categoria->id_categoria_negocio, $currentCategorias)) checked @endif
                    >
                    <label class="form-check-label" for="cat-{{ $categoria->id_categoria_negocio }}">
                        {{ $categoria->nombre_categoria }}
                    </label>
                </div>
            @empty
                <p class="text-muted">No hay categorías para seleccionar.</p>
            @endforelse
        </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Imágenes (sube más)</label>
      <div class="upload-dropzone mb-2">Arrastra imágenes aquí o haz clic para seleccionar</div>
      <input type="file" name="images[]" class="form-control" multiple accept="image/*" style="display:none;">
      <div class="upload-progress-wrap mb-2">
        <div class="progress" style="height:6px"><div class="progress-bar" style="width:0%"></div></div>
      </div>
      <div id="preview" class="d-flex flex-wrap gap-2"></div>
    </div>
    <button class="btn btn-primary">Guardar</button>
  </form>

  @if($negocio->imagenes && $negocio->imagenes->count())
    <div class="mb-3 mt-4">
      <label class="form-label">Imágenes actuales</label>
      <div class="d-flex flex-wrap gap-2">
        @foreach($negocio->imagenes as $img)
          <div style="width:160px">
            @php
              $raw = $img->url_imagen;
              $computed = $img->getUrl();
              $exists = false;
              try {
                  $exists = \Illuminate\Support\Facades\Storage::disk('public')->exists(ltrim(str_replace('/storage/','',$raw),'/'));
              } catch (\Exception $e) {
                  $exists = false;
              }
            @endphp
            <div style="height:90px; display:flex; align-items:center; justify-content:center; background:#fff; border-radius:6px; overflow:hidden;">
              @if($computed)
                <img src="{{ $computed }}" class="img-fluid rounded" alt="">
              @else
                <div style="width:120px; height:80px; display:flex; align-items:center; justify-content:center; background:#f5f5f5; color:#999;">no image</div>
              @endif
            </div>
            
            <form action="{{ route('admin.negocios.imagen.destroy', ['negocio' => $negocio->id_negocio, 'imagen' => $img->id_imagen_negocio]) }}" method="POST" onsubmit="return confirm('Eliminar imagen?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger mt-1">Eliminar</button>
            </form>
          </div>
        @endforeach
      </div>
    </div>
  @endif

  @include('admin._upload-enhancements')
@endsection
