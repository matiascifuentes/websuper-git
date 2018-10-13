@extends('layouts.app')
@section('content')
	<div class="container text-center">
		<div class="page-header">
			<h1><i class="fa fa-shoping-cart"></i> Detalle del pedido</h1>
		</div>

		<div class="page">
			<div class="table-responsive">
				<h3>Datos del usuario</h3>
				<table class="table table-striped table-hover table-bordered"> 
					<tr><td>Nombre:</td><td>{{ Auth::user()->name }}</td></tr>
					<tr><td>Correo:</td><td>{{ Auth::user()->email }}</td></tr>
					<tr><td>Direccion:</td><td>{{ Auth::user()->address }}</td></tr>
				</table>
			</div>
			<div class="table-responsive">
				<h3>Datos del pedido</h3>
				<table class="table table-striped table-hover table-bordered">
					<tr>
						<th>Producto</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th>Subtotal</th>
					</tr>
					@foreach($cart as $item)
						<tr>
							<td>{{ $item->titulo }}</td>
							<td>${{ $item->precio }}</td>
							<td>{{ $item->cantidad }}</td>
							<td>${{ $item->precio * $item->cantidad }}</td>
						</tr>
					@endforeach
				</table><hr>
				<h3>
					<span class="label label-success">
						Total: ${{ $total }}
					</span>
				</h3><hr>
				<p>
					<a href="{{ route('cart-show') }}" class="btn btn-primary">
						<i class="fa fa-chevron-circle-left"></i> Regresar
					</a>
					<a href="{{ route('payment') }}" class="btn btn-warning">
						Pagar con <i class="fa fa-cc-paypal fa-2x"></i>
					</a>
				</p>
			</div>
		</div>
	</div>

@stop