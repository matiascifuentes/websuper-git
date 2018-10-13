@extends('layouts.app')
@section('content')

@if(Session::has('success'))
  <div class="alert alert-info">
    {{Session::get('success')}}
  </div>
@endif

<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="pull-left"><h3>Productos registrados</h3></div>
            <div class="pull-right">
              <div class="btn-group">
                <a href="{{ route('productos.create') }}" class="btn btn-info" >Nuevo producto</a>
              </div>
            </div>
          
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th>Ver</th>
                <th>Código</th>
                <th>Título</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Supermercado</th>
                <th>Url</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </thead>
              <tbody>
              @if($productos->count())  
              @foreach($productos as $producto)  
	              <tr>
                  <td><a class="btn btn-info btn-xs" href="{{route('productos.show', $producto->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                	<td>{{$producto->id}}</td>
                  <td>{{$producto->titulo}}</td>
                  <td>${{$producto->precio}}</td>
                  <td>{{$producto->categoria}}</td>
                  <td>{{$producto->descripcion}}</td>
                  <td>{{$producto->supermercado}}</td>
                  <td><a class="btn btn-primary btn-xs" href="{{url($producto->url)}}" target="_blank"><span class="fa fa-external-link"></span></a></td>
	                <td><a class="btn btn-primary btn-xs" href="{{route('productos.edit', $producto->id)}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
	                <td>
	                  <form action="{{route('productos.destroy', $producto->id)}}" method="post">
	                   {{csrf_field()}}
	                   <input name="_method" type="hidden" value="DELETE">
	                   <button class="btn btn-danger btn-xs" onclick="return confirm ('Confirmar eliminación de registro')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                  </td>
	              </tr>
                @endforeach 
                @else
                <tr>
                  <td colspan="8">¡No hay productos!</td>
                </tr>
                @endif
              </tbody>
            </table>
            {!!$productos->render()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
	