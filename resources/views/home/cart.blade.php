@extends('layouts.app')

@section('content')
	<div class="container text-center">
		<div class="page-header">
			<h1><i class="fa fa-shopping-cart"></i> Carrito de compras</h1>
		</div>	
		<div class="table-cart">
			@if(count($cart))
			<p>
				<a href="{{ route('cart-trash') }}" class="btn btn-danger">
					Vaciar carro <i class="fa fa-trash"></i>
				</a>
			</p>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Imagen</th>
							<th>Producto</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Subtotal</th>
							<th>Quitar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cart as $item)
							<tr>
								<td><img src="{{ $item->img }}"></td>
								<td>{{ $item->titulo }}</td>
								<td>${{ $item->precio }}</td>
								<td>
									<input 
										type="number" 
										min="1" 
										max="100" 
										value="{{ $item->cantidad }}"
										id="prod_{{ $item->id }}" 
									>
									<a 
										href="#" 
										class="btn btn-warning btn-update-item"
										data-href="{{ route('cart-update', $item->id) }}"
										data-id = "{{ $item->id }}"
									>
										<i class="fa fa-refresh"></i>
									</a>
								</td>
								<td>${{ $item->cantidad * $item->precio }}</td>
								<td>
									<a href="{{ route('cart-delete', $item->id) }}" class="btn btn-danger">
										<i class="fa fa-remove"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table><hr>
				
				<h3>
					<span class="label label-success">
						Total: ${{$total}}
					</span>
				</h3>

			</div>
			@else
				<h3><span class="label label-warning">No hay productos en el carro :(</span></h3>
			@endif
			<hr>
			<p>
				<a href="{{ route('home') }}" class="btn btn-primary">
					<i class="fa fa-chevron-circle-left"></i> Seguir Comprando
				</a>

				<a href="{{ route('order-detail') }}" class="btn btn-primary">
					Continuar <i class="fa fa-chevron-circle-right"></i>
				</a>
			</p>
		</div>
	</div>
@stop
