@extends('layouts.app')

@section('title','Acceso Administrativo')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card mt-5">
        <div class="card-body">
          <h4 class="card-title mb-3">Acceso administrativo</h4>

          @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
          @endif

          <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Contraseña</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between align-items-center">
              <button class="btn btn-primary">Entrar</button>
              <a href="/" class="btn btn-link">Volver al sitio</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
