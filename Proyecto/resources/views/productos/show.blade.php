@extends('layouts.app')

@section('title', $producto->nombre_producto)

@section('content')
  <div class="row">
    <div class="col-md-8">
      <h2>{{ $producto->nombre_producto }}</h2>
      <p>{{ $producto->descripcion }}</p>
      <p><strong>Precio:</strong> ₡{{ $producto->precio }}</p>
    </div>
    <div class="col-md-4">
      <h5>Comercio</h5>
      <p><a href="{{ route('negocios.show', $producto->negocio->id_negocio) }}">{{ $producto->negocio->nombre_negocio }}</a></p>
    </div>
  </div>
@endsection
