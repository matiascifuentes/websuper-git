@extends('layouts.app')
@section('content')

<br>
<div class="product-info col-sm-4">
	<div class="container text-center">
		<div id="products">
			<div class="product white-panel">
				<img src="{{ asset($producto->img) }}" width="200" height="200">
				<p></p>
				<p>
					<a class="btn btn-warning" style="margin-bottom::;px;" href="{{ route('cart-add', $producto->id) }}">Agregar</a>
				</p>
			</div>
		</div>
	</div>
</div>

<div class="col-sm-4">
	<div class="container">
		<div class="product-block">
			<h1>{{ $producto->titulo }} </h1>
			<h1>${{ $producto->precio }}</h1>
			<h5>Código: {{ $producto->id }}</h5>
			<h5>Categoría: {{ $producto->categoria }}</h5>
			<h5>Descripción: {{ $producto->descripcion }}</h5>

		</div>
	</div>
</div>

<div >
	<div class="container text-center col-sm-4">
		<hr>
		<h3>Este producto lo encuentras en </h3>
		<h1>{{ $producto->supermercado }}</h1>
		<hr>
	</div>
</div>




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
<?php
	if(count($historial)){
		echo '<div id="chart_div" class="col-lg-3 col-md-5 col-sm-5 col-xs-10" style="width: 100%; height: 500px;"></div>';
	}
	else{
		echo '<div class="text-center"><h4>No hay datos para generar gráfico de precios.</h4></div>';
	}
?>


@endsection