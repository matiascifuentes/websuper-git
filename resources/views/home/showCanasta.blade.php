@extends('layouts.app')
@section('content')

<div class="panel-heading text-center" 
  	style="font-size:30px;
        color:white;
        background:#e76114;
        margin-bottom:20px;">
    Valor canasta: ${{$total}}
</div>
<a href="{{route('canasta-add',$canastaID)}}">
	<div class="panel-heading text-center" 
	  	style="font-size:30px;
	        color:white;
	        background:#e76114;
	        margin-bottom:20px;">
	    Agregar canasta al carro
	</div>
</a>



<div class="container text-center">
	<div class="page-header">
		<h1><i class="fa fa-edit"></i>Productos de canasta</h1>
	</div>

	<div class="table-canasta">
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>Imagen</th>
							<th>Nombre</th>
							<th>Supermercado</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Subtotal</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach($prodCanasta as $prod)
							<tr>
								<td><img src="{{ $prod->img }}"></td>
								<td>{{$prod->titulo}}</td>
								<td>{{$prod->supermercado}}</td>
								<td>${{$prod->precio}}</td>
								<td>{{$prod->cantidad}}</td>
								<td>${{$prod->precio * $prod->cantidad}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<hr>
				<h3><span class="label label-success">Valor canasta: ${{$total}}</span></h3>
			</div>

			<p>
				<a class="btn btn-primary" href="{{route('canastas-cliente')}}">
					<i class="fa fa-chevron-circle-left"></i> Volver
				</a>
				<a class="btn btn-primary" href="{{route('canasta-add',$canastaID)}}">
					Agregar canasta al carro <i class="fa fa-chevron-circle-right"></i> 
				</a>
			</p>
		
	</div>
</div>

@endsection