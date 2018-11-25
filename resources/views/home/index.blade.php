@extends('layouts.app')
@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="{{ asset('img/slide.jpg')}}" alt="">
        </div>
        <div class="item">
            <img src="{{ asset('img/slide_2.jpg')}}" alt="">
        </div>
        <div class="item">
            <img src="{{ asset('img/slide_3.jpg')}}" alt="">
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div class="banner panel panel-default">
	<div class="panel-body text-center">
		<span class="glyphicon glyphicon-th"></span> NUESTROS PRODUCTOS <span class="glyphicon glyphicon-th"></span>
	</div>
</div>
<div class = "body-home">
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
			{!!$productos->render()!!}
		</div>
</div>

@endsection