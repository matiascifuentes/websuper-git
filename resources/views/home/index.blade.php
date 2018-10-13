@extends('layouts.app')
@section('content')


<div class="container text-center">
	<div id="products">
		@foreach($productos as $producto)
		<div class="product white-panel">
			<div class="producto-titulo">
				<h5>{{ $producto->titulo }}</h5><hr>
			</div>
			<img src="{{ $producto->img }}" width="200" height="200">
			<div class="product-info panel">
				<div><h4>Precio: ${{ $producto->precio }}</h4></div>
				<p>
					<a class="btn btn-warning" href="{{ route('cart-add', $producto->id) }}">Agregar</a>
					<a class="btn btn-primary" href="{{ route('home.show',$producto->id) }}">Detalles</a>
				</p>
			</div>
		</div>
		@endforeach
	</div>
</div>

@endsection