@extends('layouts.app')
@section('content')
<div class="panel panel-default">
	<div class="panel-body">
		<br>
		<div class="product-info col-sm-4">
			<div class="container text-center">
				<div id="products">
					<div class="product white-panel">
						<img src="{{ asset($producto->img) }}" width="200" height="200">
						<p></p>
						<p>
							<a class="btn btn-warning" style="margin-bottom:9px;" href="{{ route('cart-add', $producto->id) }}">Agregar</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-warning" style="margin-left:300px; margin-right: 300px;font-family:Helvetica;">
			<div class="panel-heading" style="font-size:30px;background:#e76114;color:white;">{{ $producto->titulo }}</div>
			<ul class="list-group" style="font-size:16px;">
				<li class="list-group-item">Precio: ${{ $producto->precio }}</li>
				<li class="list-group-item">Descripción: {{ $producto->descripcion }}</li>
				<li class="list-group-item">Código: {{ $producto->id }}</li>
				<li class="list-group-item">Categoría: {{ $producto->categoria }}</li>
			</ul>
		</div>

			<div class="container text-center col-sm-4">
				<hr>
				<h3>Este producto lo encuentras en </h3>
				<h1>{{ $producto->supermercado }}</h1>
				<hr>
		    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		    <script type="text/javascript">
		      google.charts.load('current', {'packages':['corechart']});
		      google.charts.setOnLoadCallback(drawChart);
		      function drawChart() {
		        var data = google.visualization.arrayToDataTable([
		          ['Fecha', 'Precio'],
		          @foreach ($historial as $dato)
		          	['{{ $dato->fecha }}' , {{ $dato->precio }}],
		          @endforeach
		        ]);

		        var options = {
		          title: 'Historial de precios',
		          hAxis: {title: 'Fecha',  titleTextStyle: {color: 'black'}, format:"yyyy-MM-dd"},
		          vAxis: {minValue: 0, format: ''}
		        };

		        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
		        chart.draw(data, options);
		      }
		    </script>

			@if(count($historial))
						</div>
							<div id="chart_div" class="col-lg-3 col-md-5 col-sm-5 col-xs-10" style="width: 100%; height: 500px;"></div>

				</div>
			</div>

			@else
							<div class="row"><h4>No hay datos para generar gráfico de precios.</h4></div>
						</div>
					</div>
				</div>
			</div>
			@endif
@endsection