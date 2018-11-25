@extends('layouts.app')
@section('content')
<div class="panel-heading text-center" 
	  style="font-size:30px;
	        color:white;
	        background:#e76114;
	        margin-bottom:20px;">
	    Top Productos Mas Vendidos
	</div>
	<div class="container text-center">
		<div class="page">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<tr>
						<th style="text-align:center">Rank</th>	
						<th style="text-align:center">Producto</th>
						<th style="text-align:center">Precio</th>
						<th style="text-align:center">Categoria</th>
						<th style="text-align:center">Supermercado</th>
						<th style="text-align:center">Total Vendidos</th>
						<th style="text-align:center">Ver</th>
						<th style="text-align:center">Agregar</th>
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