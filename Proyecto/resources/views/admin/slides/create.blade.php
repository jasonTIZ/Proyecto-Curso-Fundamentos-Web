@extends('admin.layout')

@section('title', 'Añadir Nuevo Slide')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Añadir Nuevo Slide</h1>
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

    <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título (opcional)</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción (opcional)</label>
            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Enlace de Interés (opcional)</label>
            <input type="url" name="link" id="link" class="form-control" value="{{ old('link') }}" placeholder="https://ejemplo.com">
            @error('link')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen (requerido)</label>
            <input type="file" name="image" id="image" class="form-control" required>
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar Slide</button>
    </form>
@endsection
