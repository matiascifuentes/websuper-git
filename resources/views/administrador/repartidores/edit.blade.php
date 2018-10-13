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
										<input type="text" name="nombre" id="nombre" class="form-control input-sm" value="{{$repartidor->nombre}}">
									</div>
								</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="edad" id="edad" class="form-control input-sm" value="{{$repartidor->edad}}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="direccion" id="direccion" class="form-control input-sm" value="{{$repartidor->direccion}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="correo" id="correo" class="form-control input-sm" value="{{$repartidor->correo}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control input-sm" value="{{$repartidor->fecha_ingreso}}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="situacion" id="situacion" class="form-control input-sm" value="{{$repartidor->situacion}}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="disponibilidad" id="disponibilidad" class="form-control input-sm" value="{{$repartidor->disponibilidad}}">
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