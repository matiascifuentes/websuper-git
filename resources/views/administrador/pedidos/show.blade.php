@extends('layouts.app')
@section('content')
<div class="panel panel-default">
	<div class="panel-body" style="padding-right:40px">
		<br>
		<div class="product-info col-sm-3 text-center" style="padding-right:0px;">
					<div class="product white-panel">
						<img src="https://img.freepik.com/vector-gratis/nino-sentado-carrito-compras-supermercado_3446-359.jpg?size=338&ext=jpg" width="200" height="200">
						<p></p>
						<p>
							<a class="btn btn-warning" style="margin-bottom:9px;" href="{{ route('h-pedidos')}}">Volver</a>
						</p>
					</div>
		</div>
		<div class="panel panel-warning col-sm-9" style="font-family:Helvetica;padding:0px;">
			<div class="panel-heading" style="font-size:30px;background:#e76114;color:white;">Detalle del pedido</div>
			<div class="panel-body">
				<table id = "mytable" class="table table-bordered table-striped col-sm-8">
					<thead>
							<tr>
								<th>Imagen</th>
								<th>Producto</th>
								<th>Cantidad</th>
								<th>Precio Unitario</th>
								<th>Total</th>
							
							</tr>
					</thead>
					<tbody>
							@if($detalle_pedido->count())  
	              			@foreach($detalle_pedido as $detalle_pedidos) 
								<tr> 
									<td><img src="{{ $detalle_pedidos->img }}" style="max-width: 100px; max-height: 200px"></td>
									<td>{{ $detalle_pedidos->titulo }}</td>
									<td>{{ $detalle_pedidos->cantidad }}</td>
									<td>${{ $detalle_pedidos->precio }}</td>
									<td>${{ $detalle_pedidos->cantidad * $detalle_pedidos->precio }}</td>
								</tr>
							@endforeach
							@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection