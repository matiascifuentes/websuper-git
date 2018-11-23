@extends('layouts.app')

@section("content")
<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>ID Pedido</th>
							<th>Fecha de Recepcion</th>
							<th>Fecha de Entrega</th>
						</tr>
					</thead>
					<tbody>
						@if($entregas->count())  
              			@foreach($entregas as $entrega) 
							<tr> 
								<td>{{ $entrega->pedido_id }}</td>
								<td>{{ $entrega->created_at }}</td>
								<td>{{ $entrega->updated_at }}</td>
							</tr>
						@endforeach
						@endif
					</tbody>
				</table>
</div>
@endsection
