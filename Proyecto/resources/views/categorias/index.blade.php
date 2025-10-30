@extends('layouts.app')

@section('title','Categorías')

@section('content')
  <h1>Categorías de negocios</h1>
  <ul class="list-group">
    @foreach($categorias as $c)
      <li class="list-group-item"><a href="#">{{ $c->nombre_categoria }}</a></li>
    @endforeach
  </ul>
@endsection
