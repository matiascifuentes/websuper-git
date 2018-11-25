@extends('layouts.app')
@section("content")
<div class="panel panel-default" style="font-family:'Helvetica'; margin-top:15px;">
	<div class="panel-heading text-center" 
	  style="font-size:30px;
	        color:white;
	        background:#e76114;">
	    Historial de Tus Compras
	</div>
	<div class="panel-body">
		<div class="table-responsive">
						<table class="table table-striped table-hover table-bordered text-center">
							<thead>
								<tr>
									<th style="text-align:center;">ID Compra</th>
									<th style="text-align:center;">Fecha de compra</th>
									<th style="text-align:center;">Total</th>
								</tr>
							</thead>
							<tbody>
								@if($pedidos->count())  
		              			@foreach($pedidos as $pedido) 
									<tr> 
										<td>{{ $pedido->id }}</td>
										<td>{{ $pedido->created_at }}</td>
										<td>{{ $pedido->subtotal }}</td>
									</tr>
								@endforeach
								@endif
							</tbody>
						</table>
		</div>
	</div>
</div>
@endsection
