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
											<input type="text" name="name" id="name" class="form-control input-sm" placeholder="Nombre del Repartidor">
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
											<input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control input-sm" placeholder="Fecha_ingreso">
										</div>
									</div>

									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="col-xs-6 col-sm-6 col-md-6">
											<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Situación') }}</label>
										</div>
										<div class="col-xs-6 col-sm-6 col-md-6">
											<div class="form-group">
												<select class="form-control" name="situacion" id="situacion" value="activo">
						   							<option value="Activo">Activo</option>
						                         	<option value="Inactivo">Inactivo</option>
						                      	</select>
										
											</div>
										</div>
									</div>
									
									<div class="col-xs-6 col-sm-6 col-md-6">
										<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Disponibilidad') }}</label>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<select class="form-control" name="disponibilidad" id="disponibilidad" value="disponible">
					   							<option value="Disponible">Disponible</option>
					                         	<option value="No disponible">No disponible</option>
					                         	<option value="En reparto">En reparto</option>
					                      	</select>
									
										</div>
									</div>
								</div>
						

						<div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
								 <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirme contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

									<div class="col-xs-12 col-sm-12 col-md-12">
										<input type="submit"  value="Guardar" class="btn btn-success btn-block">
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
</div>
@endsection