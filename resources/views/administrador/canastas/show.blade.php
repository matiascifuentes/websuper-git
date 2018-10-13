@extends('layouts.app')
@section('content')
<div class="container text-center">
	<div class="page-header">
		<h1><i class="fa fa-edit"></i>Productos de canasta</h1>
	</div>

	<div class="table-canasta">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Imagen</th>
							<th>Nombre</th>
							<th>Supermercado</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Subtotal</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach($prodCanasta as $prod)
							<tr>
								<td><img src="{{ $prod->img }}"></td>
								<td>{{$prod->titulo}}</td>
								<td>{{$prod->supermercado}}</td>
								<td>${{$prod->precio}}</td>
								<td>{{$prod->cantidad}}</td>
								<td>${{$prod->precio * $prod->cantidad}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<hr>
				<h3><span class="label label-success">Valor canasta: ${{$total}}</span></h3>
			</div>

			
				<a class="btn btn-primary" href="{{route('canastas.index')}}">
					<i class="fa fa-chevron-circle-left"></i> Volver
				</a>
			</p>
		
	</div>
</div>

@endsection