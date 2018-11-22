@extends('layouts.app')
@section('content')

@if(Auth::guard('repartidores')->user()->disponibilidad == "Disponible")
	<div class="alert alert-info">
		<strong>¡Te encuentras disponible!</strong> Revisa constantemente los pedidos que se te han asignado.
	</div>
@else
	<div class="alert alert-warning">
	  <strong>¡No te encuentras disponible!</strong> No se te asignarán pedidos. Para recibir pedidos cambia tu estado a Disponible.
	  <br>
	  <strong>¡Importante!</strong> Si tienes entregas en curso debes entregarlas.
	</div>
@endif			


<!--Jumbotron!-->
<div class="jumbotron">
 <div class="container">
 	 <h1 class="display-4">Bienvenido {{Auth::guard('repartidores')->user()->name}}</h1>
 	<p class="lead">En esta pestaña encuentras la visualización de tus pedidos, no olvides atenderlos con prontitud.</p>
 	<hr class="my-4">
	<p>Si necesitas obtener información respecto a los horarios y direcciones de nuestros supermercados asociados presiona el boton información.</p>
	<p class="lead">
	  <a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="collapse" data-target="#info">Información</a>
	</p>
		<div id="info" class="collapse">
		    

			<div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">Supermercado Lider</h4>
			   	</div>
			    <div class="panel-body">
					<address>
					   <strong>Sucursales Lider: <a href="https://www.lider.cl/electrohogar/info/NuestrosLocales">Locales</a></strong><br><br>
						 
					  <strong>Horarios de antencion:</strong><br>					  
					  Lun a Vie de 08:00 a 22:00 hrs <br>
					  Sáb y Dom 09:00 a 22:00 hrs<br>
					  <abbr title="Phone">Servicio al Cliente:</abbr> 600 600 9191<br>
					  <strong>Pagina Web contacto: <a href="https://www.lider.cl/supermercado/contactus/?type=person">Lider.cl</a></strong><br>

					</address>

				</div>
	  		</div>

			<div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">Supermercado Jumbo</h4>
			    </div>
			      <div class="panel-body">
			      	<address>
					   <strong>Sucursales Jumbo: <a href="https://nuevo.jumbo.cl/institucional/locales-jumbo">Locales</a></strong><br><br>
						 
					  <strong>Horarios de antencion:</strong><br>					  
					 lunes a domingo de 09:00 a 21:00 horas <br>
					  <abbr title="Phone">Servicio al Cliente:</abbr> 600 400 3000<br>
					  <strong>Pagina Web contacto: <a href="https://nuevo.jumbo.cl/institucional/contacto">Jumbo.cl</a></strong><br>

					</address>
			      </div>
			  </div>


 		</div>
	</div>
</div>

<!-- fin Jumbotron!-->

<div class="row">
	<div class="container text-center">
	<h1>Disponibilidad</h1>
	</div>
	<section class="content">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
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
				</div>
			</div>
		</div>
	</section>
</div>



<hr>
<br>

<div class="container text-center">
	<h1>Entregas en curso</h1>
</div>

<!-- Script que actualiza la tabla de entregas cada cierto tiempo -->
<script type="text/javascript">
	var auto_refresh = setInterval(
		function(){
			$('#entregas').load('<?php echo url('/repartidor/entregasEnCurso'); ?>').fadeIn("slow");
		},2000);
</script>


<!-- Tabla de entregas en curso -->
<div class="row">
	<section class="content">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<div id="entregas" class="table-container">
						<!-- Aqui se ejecuta el script -->
					</div>
				</div>
			</div>
		</div>
	</section>
</div>



@endsection