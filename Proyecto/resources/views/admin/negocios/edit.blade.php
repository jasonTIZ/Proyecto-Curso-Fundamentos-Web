@extends('admin.layout')

@section('title','Editar negocio')

@section('content')
  <h1>Editar negocio</h1>
  <form action="{{ route('admin.negocios.update', $negocio->id_negocio) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre_negocio" value="{{ $negocio->nombre_negocio }}" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Descripcion</label>
      <textarea name="descripcion" class="form-control">{{ $negocio->descripcion }}</textarea>
    </div>
    <button class="btn btn-primary">Guardar</button>
  </form>
@endsection
