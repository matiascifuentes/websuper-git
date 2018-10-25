
<table id="mytable" class="table table-bordred table-striped">
	<thead>
		<th>ID Entrega</th>
		<th>ID Pedido</th>
		<th>ID Repartidor</th>
		<th>Estado</th>
	</thead>
	<tbody>
		@if($entregas->count())  
			@foreach($entregas as $entrega)  
				<tr>
					<td>{{$entrega->id}}</td>
					<td>{{$entrega->pedido_id}}</td>
					<td>{{$entrega->repartidor_id}}</td>
					<td>{{$entrega->estado}}</td>
			  	</tr>
			@endforeach 
		@else
			<tr>
				<td colspan="8">¡No tienes entregas asignadas!</td>
			</tr>
		@endif
	</tbody>
</table>
