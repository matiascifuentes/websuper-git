@extends('layouts.app')
@section('content')

<div class="container white">
	<div class="row">
		<section class="content">
			<div class="col-md-8 col-md-offset-2">

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

				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Nuevo repartidor</h3>
					</div>
					<div class="panel-body">					
						<div class="table-container">
							<form method="POST" action="{{ route('repartidores.store') }}"  role="form">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre del Repartidor">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="edad" id="edad" class="form-control input-sm" placeholder="Edad">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="direccion" id="direccion" class="form-control input-sm" placeholder="Direccion">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="correo" id="correo" class="form-control input-sm" placeholder="Correo">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control input-sm" placeholder="Fecha_ingreso">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="situacion" id="situacion" class="form-control input-sm" placeholder="Situacion">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="disponibilidad" id="disponibilidad" class="form-control input-sm" placeholder="disponibilidad">
										</div>
									</div>
								</div>

									<div class="col-xs-12 col-sm-12 col-md-12">
										<input type="submit"  value="Guardar" class="btn btn-success btn-block">
										<a href="{{ route('productos.index') }}" class="btn btn-info btn-block" >Cancelar</a>
									</div>	

								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
		</section>
	</div>
</div>
@endsection