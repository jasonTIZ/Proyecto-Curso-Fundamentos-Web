@extends('layouts.app')

@section('title', $negocio->nombre_negocio)

@section('content')
  <div class="row">
    <div class="col-md-8">
      <h2>{{ $negocio->nombre_negocio }}</h2>
      <p>{{ $negocio->descripcion }}</p>
      <h5>Productos</h5>
      <ul>
        @foreach($negocio->productos as $p)
          <li><a href="{{ route('productos.show', $p->id_producto) }}">{{ $p->nombre_producto }} - ₡{{ $p->precio }}</a></li>
        @endforeach
      </ul>
      <h5>Galería</h5>
      <div class="row">
        @foreach($negocio->imagenes as $img)
          <div class="col-4 mb-2"><img src="{{ $img->url_imagen }}" class="img-fluid" alt=""></div>
        @endforeach
      </div>
    </div>
    <div class="col-md-4">
      <h5>Contacto</h5>
      <p>{{ $negocio->telefono }}<br>{{ $negocio->email }}</p>
    </div>
  </div>
@endsection
