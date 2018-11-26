@extends('layouts.app')

@section("content")
<div class="panel panel-default" style="font-family:Helvetica;">
	<div class="panel-heading text-center" style="font-size:30px;
	        color:white;
	        background:#e76114;"> 
	    Historial de Entregas
	</div>
	<div class="panel-body">
		<div class="table-responsive" style="text-align:center;">
			<table class="table table-striped table-hover table-bordered text-center">
				<thead>
					<tr>
						<th style="text-align:center;">ID Pedido</th>
						<th style="text-align:center;">Fecha de Recepcion</th>
						<th style="text-align:center;">Fecha de Entrega</th>
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
	</div>
</div>
@endsection
