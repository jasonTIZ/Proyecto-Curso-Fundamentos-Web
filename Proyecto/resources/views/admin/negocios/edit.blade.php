@extends('admin.layout')

@section('title','Editar negocio')

@section('content')
  <h1>Editar negocio</h1>
  <form action="{{ route('admin.negocios.update', $negocio->id_negocio) }}" method="POST" enctype="multipart/form-data" class="ajax-upload-form">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre_negocio" value="{{ $negocio->nombre_negocio }}" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Descripcion</label>
      <textarea name="descripcion" class="form-control">{{ $negocio->descripcion }}</textarea>
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
