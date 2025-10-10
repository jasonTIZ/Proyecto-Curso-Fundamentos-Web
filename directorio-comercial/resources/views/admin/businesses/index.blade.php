@extends('admin.layouts.app')

@section('title', 'Gestión de Comercios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestión de Comercios</h1>
    <a href="{{ route('admin.businesses.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Nuevo Comercio
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($businesses->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Categorías</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($businesses as $business)
                            <tr>
                                <td>
                                    @if($business->featured_image)
                                        <img src="{{ asset('storage/' . $business->featured_image) }}" 
                                             alt="{{ $business->name }}" 
                                             style="width: 50px; height: 50px; object-fit: cover;" 
                                             class="rounded">
                                    @else
                                        <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="bi bi-image text-white"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $business->name }}</td>
                                <td>
                                    @foreach($business->categories as $category)
                                        <span class="badge bg-primary me-1">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>{{ Str::limit($business->address, 50) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.products.index', $business) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-box"></i> Productos
                                        </a>
                                        <a href="{{ route('admin.businesses.edit', $business) }}" 
                                           class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.businesses.destroy', $business) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este comercio?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-building display-1 text-muted"></i>
                <h4 class="mt-3">No hay comercios registrados</h4>
                <p class="text-muted">Comienza agregando tu primer comercio</p>
                <a href="{{ route('admin.businesses.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Crear Primer Comercio
                </a>
            </div>
        @endif
    </div>
</div>
@endsection