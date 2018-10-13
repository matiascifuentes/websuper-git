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
						<h3 class="panel-title">Nuevo producto</h3>
					</div>
					<div class="panel-body">					
						<div class="table-container">
							<form method="POST" action="{{ route('productos.store') }}"  role="form">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="nombre" id="nombre" class="form-control input-sm" placeholder="Nombre del producto">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="precio" id="precio" class="form-control input-sm" placeholder="Precio del producto">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="descripcion" id="descripcion" class="form-control input-sm" placeholder="Descripción">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<input type="text" name="categoria" id="categoria" class="form-control input-sm" placeholder="Categoría">
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-6">
										<div class="form-group">
											<select class="form-control" name="supermercado" id="supermercado" value="Supermercado 1">
					   							<option value="Lider">Lider</option>
					                         	<option value="Jumbo">Jumbo</option>
					                      </select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="img" id="img" class="form-control input-sm" placeholder="URL imagen">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group">
											<input type="text" name="url" id="url" class="form-control input-sm" placeholder="URL producto">
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