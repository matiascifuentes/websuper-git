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

<div class="container">
	<h1 align="center"> Ventas Mensuales</h1><br />
	<div class="row">
		<div class="col-md-4" align="right">
			<h4>Informe de ventas del mes de: {{ $mes }}</h4>
		</div>
		<div class="col-md-7" align="right">
    		 <a href="{{ url('administrador/info_mes/pdfmes') }}" class="btn btn-danger">Convertir a PDF</a>
		</div>
	</div>
	<br />
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<thead>
				<th>Pedidos Totales</th>
				<th>Venta Total</th>
			</thead>
			<tbody>
				<tr>
					<td align="center"> {{ $totalPedidos }}</td>
					<td align="center"> {{ $total_mes }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

@endsection