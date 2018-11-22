@extends('layouts.app')
@section('content')

<div>
  <span class="glyphicon glyphicon-chevron-left"></span>
  <a class="btn btn-warning" href="{{route('usuarios.index')}}">Volver</a>
  <hr>
</div>

<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Datos del cliente</h3></div>
            <div class="pull-right">
            </div>
          
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
              <tbody>
                 @if(($usuario->tipo)!='administrador') 
                  <tr>
                  	<th>Código</th>
                    <td>{{$usuario->id}}</td>
                  </tr>
                  <tr>
                  	<th>Nombre</th>
                  	<td>{{$usuario->name}}</td>
                  </tr>
                  <tr>
                  	<th>Email</th>
                  	<td>{{$usuario->email}}</td>
                  </tr>
                  <tr>
                  	<th>Región</th>
                  	<td>{{$usuario->region}}</td>
                  </tr>
                  <tr>
                  	<th>Ciudad</th>
                  	<td>{{$usuario->city}}</td>
                  </tr>
                  <tr>
                  	<th>Dirección</th>
                  	<td>{{$usuario->address}}</td>
                  </tr>
                  <tr>
                  	<th>Telefono</th>
                  	<td>{{$usuario->phone}}</td>
                  </tr>
                  <tr>
                  	<th>Estado</th>
                  	<td>{{$usuario->tipo}}</td>
                  </tr>
                  <tr>
                  	<th>Fecha creación</th>
                  	<td>{{$usuario->created_at}}</td>
                  </tr>
                    
                  @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>


@endsection