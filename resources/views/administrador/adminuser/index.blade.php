@extends('layouts.app')
@section('content')

@if(Session::has('success'))
  <div class="alert alert-info">
    {{Session::get('success')}}
  </div>
@endif

<div>
  <span class="glyphicon glyphicon-chevron-left"></span>
  <a class="btn btn-warning" href="{{url('/administrador/home') }}">Volver</a>
  <hr>
</div>

<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Clientes registrados</h3></div>
            <div class="pull-right">
            </div>
          
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th>Ver</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Editar</th>
              </thead>
              <tbody>
              @if($usuarios->count())  
              @foreach($usuarios as $usuario)  
                 @if(($usuario->tipo)!='administrador') 
                  <tr>
                    <td><a class="btn btn-info btn-xs" href="{{route('usuarios.show', $usuario->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->tipo}}</td>
                    <td><a class="btn btn-primary btn-xs" href="{{route('usuarios.edit', $usuario->id)}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                  </tr>
                  @endif
                @endforeach 
                @else
                <tr>
                  <td colspan="8">¡No hay clientes!</td>
                </tr>
                @endif
              </tbody>
            </table>
            {!!$usuarios->render()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
  