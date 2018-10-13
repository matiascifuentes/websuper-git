@extends('layouts.app')
@section('content')

<h1>Bienvenido:{{auth()->user()->email}}</h1>


<hr>
<div class="text-center">
  <h1>Panel de administración</h1>
</div>
<div class="btn-group btn-group-justified">
  <a href="{{route('productos.index')}}" class="btn btn-primary">Productos</a>
  <a href="{{route('canastas.index')}}" class="btn btn-primary">Canastas</a>
  <a href="{{route('repartidores.index')}}" class="btn btn-primary">Repartidores</a>
  <a href="{{route('usuarios.index')}}" class="btn btn-primary">Clientes</a>
</div>
<hr>

@endsection