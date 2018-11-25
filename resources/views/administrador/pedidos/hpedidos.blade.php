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
          <div class="pull-left"><h3>Historial de pedidos entregados</h3></div>
          <div class="table-container">
            <table id="mytable" class="table table-borderd table-striped">
              <thead>
                <th>Información Pedido</th>
                <th>Código Pedido</th>
                <th>Nombre Repartidor</th>
                <th>Fecha de Compra</th>
                <th>Fecha de Entrega</th>
              </thead>
              <tbody>
              @foreach($pedidos as $pedido)  
	              <tr>
                  <td><a class="btn btn-info btn-xs" href="{{route('det-pedido',$pedido->pedido_id) }}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                	<td>{{$pedido->pedido_id}}</td>
                  <td>{{$pedido->name}}</td>
                  <td>{{$pedido->created_at}}</td>
                  <td>{{$pedido->updated_at}}</td>              
	              </tr>
                @endforeach 
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection