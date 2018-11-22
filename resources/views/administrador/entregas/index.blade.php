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
          <div class="pull-left"><h3>Pedidos en curso</h3></div>
          
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th>informacion pedido</th>
                <th>Codigo</th>
                <th>Pedido</th>
                <th>Id_Repartidor</th>
                <th>Estado</th>
                <th>ip</th>
              </thead>
              <tbody>
              @if($entregas->count())  
              @foreach($entregas as $entrega)  
	              <tr>
                  <td><a class="btn btn-info btn-xs" href="{{route('entrega.show', $entrega->pedido_id)}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                	<td>{{$entrega->id}}</td>
                  <td>{{$entrega->pedido_id}}</td>
                  <td>{{$entrega->repartidor_id}}</td>
                  <td>{{$entrega->estado}}</td>
                  <td>{{$entrega->ip}}</td>

	               
	              </tr>
                @endforeach 
                @else
                <tr>
                  <td colspan="8">¡No hay pedidos en curso!</td>
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
	