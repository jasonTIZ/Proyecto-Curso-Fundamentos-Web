@extends('admin.layout')

@section('title', 'Gestionar Slider')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Slider Principal</h1>
        <a href="{{ route('admin.slides.create') }}" class="btn btn-primary">Añadir nuevo slide</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 150px;">Imagen</th>
                    <th>Título</th>
                    <th>Enlace</th>
                    <th style="width: 150px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($slides as $slide)
                    <tr>
                        <td>
                            @if($slide->image_url)
                                <img src="{{ Storage::url($slide->image_url) }}" alt="{{ $slide->title }}" style="width: 100%; height: auto; max-width: 120px;">
                            @endif
                        </td>
                        <td>{{ $slide->title ?: 'N/A' }}</td>
                        <td>
                            @if($slide->link)
                                <a href="{{ $slide->link }}" target="_blank">{{ $slide->link }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.slides.edit', $slide) }}" class="btn btn-sm btn-secondary">Editar</a>
                            <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este slide?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No hay slides para mostrar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $slides->links() }}
    </div>
@endsection
