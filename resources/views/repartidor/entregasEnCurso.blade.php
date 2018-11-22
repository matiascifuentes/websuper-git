<div class="pull-left"><h3>Tienes {{$entregas->count()}} entregas pendientes.</h3></div>
<table id="mytable" class="table table-bordred table-striped">
	<thead>
		<th>ID Entrega</th>
		<th>Pedido</th>
		<th>Estado</th>
		<th>Hora pedido</th>
		<th>Confirmar entrega</th>
	</thead>
	<tbody>
		@if($entregas->count())  
			@foreach($entregas as $entrega)  
				<tr>
					<td>{{$entrega->id}}</td>
					<td><a class="btn btn-info btn-xs" href="{{route('detalleEntrega-show',$entrega->pedido_id)}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
					<td>
						{{$entrega->estado}}
					</td>
					<td>{{$entrega->created_at}}</td>
					<td>
						<a class="btn btn-success" href="{{ route('updateEntrega',$entrega->id) }}" onclick="return confirm ('Confirmar entrega del pedido')">¿Entregado?</a>
					</td>
			  	</tr>
			@endforeach 
		@else
			<tr>
				<td colspan="8">¡No tienes entregas asignadas en este momento!</td>
			</tr>
		@endif
	</tbody>
</table>
