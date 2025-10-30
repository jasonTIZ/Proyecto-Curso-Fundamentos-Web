@extends('layouts.app')

@section('title','Inicio')

@section('content')
  <h1>Últimos negocios</h1>
  <div class="row">
    @forelse($negocios as $n)
      <div class="col-md-4">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">{{ $n->nombre_negocio }}</h5>
            <p class="card-text">{{ Str::limit($n->descripcion,120) }}</p>
            <a href="{{ route('negocios.show', $n->id_negocio) }}" class="btn btn-primary">Ver</a>
          </div>
        </div>
      </div>
    @empty
      <p>No hay negocios aún.</p>
    @endforelse
  </div>
@endsection
