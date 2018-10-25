@extends('layouts.app')
@section('content')

<br>
<div class="product-info col-sm-4">
	<div class="container text-center">
		<div id="products">
			<div class="product white-panel">
				<img src="https://img.freepik.com/vector-gratis/nino-sentado-carrito-compras-supermercado_3446-359.jpg?size=338&ext=jpg" width="200" height="200">
				<p></p>
					<a class="btn btn-warning" href="{{ route('entrega.index') }}">Volver</a>

			</div>
		</div>
	</div>
</div>

<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Imagen</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Cantidad</th>
						
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





@endsection