@extends('layouts.app')
@section('content')

@if(Session::has('success'))
  <div class="alert alert-info">
    {{Session::get('success')}}
  </div>
@endif

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
                <th>Código</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Región</th>
                <th>Ciudad</th>
                <th>Dirección</th>
                <th>Telefono</th>
                <th>Estado</th>
                <th>Fecha creación</th>
                <th>Ultima sesión</th>
                <th>Editar</th>
              </thead>
              <tbody>
              @if($usuarios->count())  
              @foreach($usuarios as $usuario)  
                 @if(($usuario->tipo)!='administrador') 
                  <tr>
                    <td>{{$usuario->id}}</td>
                    <td>{{$usuario->name}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->region}}</td>
                    <td>{{$usuario->city}}</td>
                    <td>{{$usuario->address}}</td>
                    <td>{{$usuario->phone}}</td>
                    <td>{{$usuario->tipo}}</td>
                    <td>{{$usuario->created_at}}</td>
                    <td>{{$usuario->updated_at}}</td>
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
  