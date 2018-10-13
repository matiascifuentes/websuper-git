@extends('layouts.app')
@section('content')
	<div class="container text-center">
		<div class="page header">
			<h1>Top Productos Mas Vendidos</h1>
		</div>
		<div class="page">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<tr>
						<th>Rank</th>	
						<th>Producto</th>
						<th>Precio</th>
						<th>Categoria</th>
						<th>Supermercado</th>
						<th>Total Vendidos</th>
						<th>Ver</th>
						<th>Agregar</th>
					</tr>
					<?php $a = 1?>
					@foreach($tops as $item)
						<tr>
							<td>Pos.{{ $a }}°</td>
							<td>{{ $item->titulo }}</td>
							<td>${{ $item->precio }}</td>
							<td>{{ $item->categoria }}</td>
							<td>{{ $item->supermercado }}</td>
							<td>{{ $item->totalventas }}</td>
                 			<td>
                 				<a class="btn btn-info btn-xm" href="{{ route('home.show', $item->product_id) }}">
                 					<span class="glyphicon glyphicon-eye-open"></span>
                 				</a>
                 			</td>
                 			<td>
                 				<a class="btn btn-warning btn-xm" href="{{ route('cart-add', $item->product_id) }}">
                 					<span class="glyphicon glyphicon-shopping-cart"></span>
                 				</a>
                 			</td>
						</tr>
					<?php $a++ ?>
					@endforeach
				</table>
			</div>
		</div>
	</div>

@stop