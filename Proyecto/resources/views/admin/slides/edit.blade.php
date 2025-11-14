@extends('admin.layout')

@section('title', 'Editar Slide')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Editar Slide</h1>
        <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.slides.update', $slide) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Título (opcional)</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $slide->title) }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción (opcional)</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $slide->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Enlace de Interés (opcional)</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ old('link', $slide->link) }}" placeholder="https://ejemplo.com">
            @error('link')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Cambiar Imagen (opcional)</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @if($slide->image_url)
                <div class="mt-2">
                    <p class="mb-1">Imagen actual:</p>
                    <img src="{{ $slide->getUrl() }}" alt="{{ $slide->title }}" style="width: 100%; height: auto; max-width: 200px; border-radius: 5px;">
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Slide</button>
    </form>
@endsection
