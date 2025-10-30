@extends('admin.layout')

@section('title','Dashboard')

@section('content')
  <h1>Panel administrativo</h1>
  <p>Total negocios: {{ $totalNegocios }}</p>
@endsection
