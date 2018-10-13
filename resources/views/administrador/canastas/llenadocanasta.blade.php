@extends('layouts.app')
@section('content')
<div class="container text-center">
	<div class="page-header">
		<h1><i class="fa fa-edit"></i>Productos de canasta</h1>
	</div>



	<div class="table-canasta">
		@if(count($prodCanasta))

			<p>
				<a class="btn btn-danger" href="{{ route('prodCanasta-vaciar') }}" onclick="return confirm ('¿Vaciar la canasta?')">
					<i class="fa fa-trash">Vaciar</i>
				</a>
			</p>

			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Imagen</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Subtotal</th>
							<th>Quitar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($prodCanasta as $prod)
							<tr>
								<td><img src="{{ $prod->img }}"></td>
								<td>{{$prod->titulo}}</td>
								<td>${{$prod->precio}}</td>
								<td>
									<input 
										type="number"
										min="1"
										max="100" 
										value="{{$prod->cantidad}}"
										id="prod_{{$prod->id}}" 
									>
									<a 
										href="#"
										class="btn btn-warning btn-update-item" 
										data-href="{{route('prodCanasta-update',$prod->id)}}"
										data-id="{{$prod->id}}"
									>
										<i class="fa fa-refresh"></i>
									</a>
								</td>
								<td>${{$prod->precio * $prod->cantidad}}</td>
								<td>
									<a href="{{ route('prodCanasta-delete',$prod->id) }}" class="btn btn-danger" onclick="return confirm ('¿Quitar el producto?')">
										<i class="fa fa-close"></i>
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<hr>
				<h3><span class="label label-success">Valor canasta: ${{$total}}</span></h3>
			</div>

			<hr>
			<p>
				<a class="btn btn-primary" href="{{route('canastas-buscador')}}">
					<i class="fa fa-chevron-circle-left"></i> Agregar más productos
				</a>
				<a class="btn btn-primary" href="{{route('canastas.create')}}">
					Continuar<i class="fa fa-chevron-circle-right"></i>
				</a>
			</p>
		@else
			<h3><span class="label label-warning">No hay productos en la canasta</span></h3>
			<hr>
			<p>
				<a class="btn btn-primary" href="{{route('canastas-buscador')}}">
					<i class="fa fa-chevron-circle-left"></i> Volver
				</a>
			</p>
		@endif
		
	</div>
</div>

@endsection