@extends('layouts.app')
@section('content')
<div class="container text-center">
	<div class="page-header">
		<h1><i class="fa fa-edit"></i>Guardar canasta</h1>
	</div>

	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>¡Error!</strong> Revise los campos obligatorios.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<div class="table-canasta">
		@if(count($prodCanasta))
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Detalle canasta</h3>
			</div>

		</div>
			
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Imagen</th>
							<th>Nombre</th>
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

			
		@endif
			<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Datos canasta</h3>
					</div>
					<div class="panel-body">					
						<div class="table-container">
							<form method="POST" action="{{ route('canastas.store') }}"  role="form">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre de la canasta">
										</div>
										<div class="form-group">
											<input type="text" name="descripcion" id="descripcion" class="form-control input-sm" placeholder="Descripción">
										</div>
									</div>
									
								</div>

								<hr>
								<p>
									<a class="btn btn-primary" href="{{route('prodCanasta-show')}}">
										<i class="fa fa-chevron-circle-left"></i> Volver
									</a>
									<input type="submit"  value="Guardar" class="btn btn-primary fa fa-chevron-circle-right">
								</p>

								</div>
							</form>
						</div>
					</div>

				</div>
		

	</div>
</div>

@endsection