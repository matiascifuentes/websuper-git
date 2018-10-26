
<table id="mytable" class="table table-bordred table-striped">
	<thead>
		<th>ID Entrega</th>
		<th>Pedido</th>
		<th>Estado</th>
	</thead>
	<tbody>
		@if($entregas->count())  
			@foreach($entregas as $entrega)  
				<tr>
					<td>{{$entrega->id}}</td>
					<td><a class="btn btn-info btn-xs" href="{{route('detalleEntrega-show',$entrega->pedido_id)}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
					<td>
						{{$entrega->estado}}
						<a class="btn btn-info btn-xs" href="#"><span class="glyphicon glyphicon-pencil"></span></a>
					</td>
			  	</tr>
			@endforeach 
		@else
			<tr>
				<td colspan="8">¡No tienes entregas asignadas!</td>
			</tr>
		@endif
	</tbody>
</table>
