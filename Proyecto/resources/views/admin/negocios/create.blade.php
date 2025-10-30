@extends('admin.layout')

@section('title','Crear negocio')

@section('content')
  <h1>Crear negocio</h1>
  <form action="{{ route('admin.negocios.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input name="nombre_negocio" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Descripcion</label>
      <textarea name="descripcion" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary">Guardar</button>
  </form>
@endsection
