@extends('layouts.app')
@section("content")
<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>ID Compra</th>
							<th>Fecha de compra</th>
							<th>Total</th>
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
@endsection
