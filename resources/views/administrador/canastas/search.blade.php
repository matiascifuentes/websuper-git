@extends('layouts.app')
@section('content')

<div class="alert alert-info">
	<strong>¡Información!</strong> La búsqueda entrega 10 coincidencias ordenadas desde el precio menor al mayor.
</div>

<form class="navbar-form navbar-left" role="search" action="{{route('canastas-buscador')}}">
	<div class="form-group">
		<input type="text" class="form-control" name='search' placeholder="Buscar productos ..." />
	</div>
	<button type="submit" class="btn btn-default fa fa-search"></button>
</form>

<div class="container text-center">
	<div class="page-header">
		<h1><i class="glyphicon glyphicon-search"></i>Resultados de búsqueda</h1>
	</div>
	<div class="table-canasta">
      	<div class="table-responsive">
	        <table id="mytable" class="table table-striped table-hover table-bordered">
	        	<thead>
		          	<th>Imagen</th>
		            <th>Título</th>
		            <th>Precio</th>
		            <th>Supermercado</th>
		            <th>Añadir</th>
	          	</thead>
	          	<tbody>
		            @if($productos->count())  
		            @foreach($productos as $producto)  
		            <tr>
						<td><img src="{{ $producto->img }}"></td>
						<td>{{$producto->titulo}}</td>
						<td>{{$producto->precio}}</td>
						<td>{{$producto->supermercado}}</td>
						<td><a class="btn btn-primary btn-xs" href="{{ route('prodCanasta-add',$producto->id) }}"><span class="fa fa-plus"></span></a></td>

						</tr>
		            @endforeach 
		            @else
	            	<tr>
	              		<td colspan="8">¡No hay coincidencias!</td>
	            	</tr>
	            	@endif
	          	</tbody>
	        </table>
    	</div>
    </div>
</div>        
@endsection