@extends('admin.layout')

@section('content')
<div class="container py-4">
    <h3>Editar Producto</h3>

    <form action="{{ route('admin.productos.update', $producto) }}" method="POST" enctype="multipart/form-data" class="ajax-upload-form">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre_producto" class="form-control" value="{{ old('nombre_producto', $producto->nombre_producto) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="id_categoria" class="form-select" required>
                <option value="">-- seleccionar --</option>
                @foreach($categorias as $c)
                    <option value="{{ $c->id_categoria }}" {{ $c->id_categoria == $producto->id_categoria ? 'selected' : '' }}>{{ $c->nombre_categoria }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Negocio</label>
            <select name="id_negocio" class="form-select" required>
                <option value="">-- seleccionar --</option>
                @foreach($negocios as $n)
                    <option value="{{ $n->id_negocio }}" {{ $n->id_negocio == $producto->id_negocio ? 'selected' : '' }}>{{ $n->nombre_negocio }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio', $producto->precio) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Imágenes actuales</label>
            <div class="d-flex gap-2 flex-wrap mb-2">
                @foreach($producto->imagenes as $img)
                    <div class="card" style="width:120px;">
                        <img src="{{ $img->url_imagen }}" class="card-img-top" style="height:80px;object-fit:cover;" />
                        <div class="card-body p-2 text-center">
                            <form action="{{ route('admin.productos.imagen.destroy', ['producto' => $producto->id_producto, 'imagen' => $img->id_imagen]) }}" method="POST" onsubmit="return confirm('Eliminar imagen?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
                        <label class="form-label">Subir nuevas imágenes</label>
                        <div class="upload-dropzone mb-2">Arrastra imágenes aquí o haz clic para seleccionar</div>
                        <input type="file" name="images[]" class="form-control" multiple style="display:none;">
                        <div class="upload-progress-wrap mb-2">
                            <div class="progress" style="height:6px"><div class="progress-bar" style="width:0%"></div></div>
                        </div>
                        <div id="preview" class="d-flex flex-wrap gap-2"></div>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    @include('admin._upload-enhancements')
</div>
@endsection
