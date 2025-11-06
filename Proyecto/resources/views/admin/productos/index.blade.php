@extends('admin.layout')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Productos</h3>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Nuevo Producto</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Negocio</th>
                <th>Precio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $p)
            <tr>
                <td>{{ $p->id_producto }}</td>
                <td>{{ $p->nombre_producto }}</td>
                <td>{{ $p->negocio->nombre_negocio ?? '—' }}</td>
                <td>₡{{ number_format($p->precio,2) }}</td>
                <td class="text-end">
                    <a href="{{ route('admin.productos.edit', $p) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                    <form action="{{ route('admin.productos.destroy', $p) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Eliminar producto?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">{{ $productos->links() }}</div>
</div>
@endsection
