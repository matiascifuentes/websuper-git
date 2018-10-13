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
					<h3 class="panel-title">Actualizar producto</h3>
				</div>
				<div class="panel-body">					
					<div class="table-container">
						<form method="POST" action="{{ route('productos.update',$producto->id) }}"  role="form">
							{{ csrf_field() }}
							<input name="_method" type="hidden" value="PATCH">
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="nombre" id="nombre" class="form-control input-sm" value="{{$producto->titulo}}">
									</div>
								</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="precio" id="precio" class="form-control input-sm" value="{{$producto->precio}}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="descripcion" id="descripcion" class="form-control input-sm" value="{{$producto->descripcion}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<input type="text" name="categoria" id="categoria" class="form-control input-sm" value="{{$producto->categoria}}">
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<select class="form-control" name="supermercado" id="supermercado" value="{{$producto->supermercado}}">
					                          <option value="Lider">Lider</option>
					                          <option value="Jumbo">Jumbo</option>
					                      </select>
								
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="img" id="img" class="form-control input-sm" value="{{$producto->img}}">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<input type="text" name="url" id="url" class="form-control input-sm" value="{{$producto->url}}">
									</div>
								</div>
							<div class="row">

								<div class="col-xs-12 col-sm-12 col-md-12">
									<input type="submit"  value="Actualizar" class="btn btn-success btn-block">
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
@endsection