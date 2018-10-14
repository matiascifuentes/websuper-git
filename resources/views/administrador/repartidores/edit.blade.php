@extends('layouts.app')
@section('content')
<div class="row">
	<section class="content">
		<div class="col-md-8 col-md-offset-2">
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Error!</strong> Revise los campos obligatorios.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if(Session::has('success'))
			<div class="alert alert-info">
				{{Session::get('success')}}
			</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Actualizar repartidor</h3>
				</div>
				<div class="panel-body">					
					<div class="table-container">
						<form method="POST" action="{{ route('repartidores.update',$repartidor->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input title="Nombre" type="text" name="name" id="name" class="form-control input-sm" value="{{$repartidor->name}}">
									</div>
								</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input title="Edad" type="text" name="edad" id="edad" class="form-control input-sm" value="{{$repartidor->edad}}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input title="Dirección" type="text" name="direccion" id="direccion" class="form-control input-sm" value="{{$repartidor->direccion}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<label title="E-mail" type="text" name="email" id="email" class="form-control input-sm"readonly="readonly">{{$repartidor->email}}</label>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input title="Fecha de ingreso" type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control input-sm" value="{{$repartidor->fecha_ingreso}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Situación') }}</label>
								</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<select class="form-control" name="situacion" id="situacion">
												@if($repartidor->situacion == "Activo")
													<option value="Activo" selected='selected'>Activo</option>
												@else
													<option value="Activo">Activo</option>
												@endif
												@if($repartidor->situacion == "Inactivo")
													<option value="Inactivo" selected='selected'>Inactivo</option>
												@else
													<option value="Inactivo">Inactivo</option>
												@endif
					   							
					                         	
					                      	</select>
									
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Disponibilidad') }}</label>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<label type="text" name="disponibilidad" id="disponibilidad" class="form-control input-sm"readonly="readonly">{{$repartidor->disponibilidad}}</label>
										</div>
									</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										
								
									</div>
								</div>

								
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
									<a href="{{ route('repartidores.index') }}" class="btn btn-info btn-block" >Cancelar</a>
								</div>	

							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</section>
</div>
@endsection