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
          <div class="pull-left"><h3>Repartidores registrados</h3></div>
            <div class="pull-right">
              <div class="btn-group">
                <a href="{{ route('repartidores.create') }}" class="btn btn-info" >Nuevo repartidor</a>
              </div>
            </div>
          
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th>Código</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Direccion</th>
                <th>Correo</th>
                <th>Fecha_ingreso</th>
                <th>Situacion</th>
                <th>Disponibilidad</th>
                <th>Editar</th>
              </thead>
              <tbody>
              @if($repartidores->count())  
              @foreach($repartidores as $repartidor)  
	              <tr>
                	<td>{{$repartidor->id}}</td>
                  <td>{{$repartidor->name}}</td>
                  <td>{{$repartidor->edad}}</td>
                  <td>{{$repartidor->direccion}}</td>
                  <td>{{$repartidor->email}}</td>
                  <td>{{$repartidor->fecha_ingreso}}</td>
                  <td>{{$repartidor->situacion}}</td>
                  <td>{{$repartidor->disponibilidad}}</td>

	                <td><a class="btn btn-primary btn-xs" href="{{route('repartidores.edit', $repartidor->id)}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
	              </tr>
                @endforeach 
                @else
                <tr>
                  <td colspan="8">¡No hay repartidores!</td>
                </tr>
                @endif
              </tbody>
            </table>
            {!!$repartidores->render()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
	