@extends('layouts.app')
@section('content')

<div class="form-group">
	<label for="sel1">Seleccione su disponibilidad:</label>
	<form method="POST" action="{{ route('repartidor.update', Auth::guard('repartidores')->user()->id) }}"  role="form">
	{{ csrf_field() }}
	<input name="_method" type="hidden" value="PATCH">
	<div class="text-center">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group">
			<select class="form-control" name="disponibilidad" id="disponibilidad" value="{{Auth::guard('repartidores')->user()->disponibilidad}}">
				@if(Auth::guard('repartidores')->user()->disponibilidad == "Disponible")
					<option value="Disponible" selected="selected">Disponible</option>
				@else
					<option value="Disponible">Disponible</option>
				@endif
				@if(Auth::guard('repartidores')->user()->disponibilidad == "No disponible")
					<option value="No disponible" selected="selected">No disponible</option>
				@else
					<option value="No disponible">No disponible</option>
				@endif
				
				
			</select>
		</div>
		</div>
		
			
		<div class="col-xs-12 col-sm-12 col-md-12">
			<input type="submit"  value="Actualizar disponibilidad" class="btn btn-success btn-block">
		</div>
	</div>	
	</form>
</div> 

<hr>
<br>
<br>
<div class="container text-center">
	<h1>AREA DE REPARTIDOR</h1>
	<h3>ESTO ES UNA PRUEBA...</h3>
	<h6>ID: {{Auth::guard('repartidores')->user()->id}}</h6>
	<h6>tipo: {{Auth::guard('repartidores')->user()->tipo}}</h6>
	<h6>tipo: {{Auth::guard('repartidores')->user()->disponibilidad}}</h6>
</div>

@endsection