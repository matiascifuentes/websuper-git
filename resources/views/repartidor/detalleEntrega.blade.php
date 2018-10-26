@extends('layouts.app')
@section('content')

<div>
	<span class="glyphicon glyphicon-chevron-left"></span>
	<a class="btn btn-warning" href="{{ route('repartidor.index') }}">Volver</a>
	<hr>
</div>


<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Supermercado</th>
							<th>Imagen</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Subtotal</th>
						
						</tr>
					</thead>
					<tbody>
						@if($detalle_pedido->count())  
              			@foreach($detalle_pedido as $detalle_pedidos) 
							<tr> 
								<td>{{ $detalle_pedidos->supermercado }}</td>
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

<div class="alert alert-info text-center">
	<hr>
 	<h3>Total: $ {{$total}}</h3>
 	<hr>
</div>


@endsection