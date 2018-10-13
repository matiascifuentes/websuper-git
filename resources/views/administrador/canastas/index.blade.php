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
          <div class="pull-left"><h3>Canastas registradas</h3></div>
            <div class="pull-right">
              <div class="btn-group">
                <a href="{{route('canastas-buscador')}}" class="btn btn-info" >Nueva canasta</a>
              </div>
            </div>
          
          <div class="table-container">
            <table id="mytable" class="table table-bordred table-striped">
              <thead>
                <th>Ver</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Creación</th>
                <th>Eliminar</th>
              </thead>
              <tbody>
              @if($canastas->count())  
              @foreach($canastas as $canasta)  
                <tr>
                  <td><a class="btn btn-info btn-xs" href="{{route('canastas.show',$canasta->id)}}"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                  <td>{{$canasta->id}}</td>
                  <td>{{$canasta->nombre}}</td>
                  <td>{{$canasta->descripcion}}</td>
                  <td>{{$canasta->created_at}}</td>
                  <td>
                    <form action="{{route('canastas.destroy',$canasta->id)}}" method="post">
                     {{csrf_field()}}
                     <input name="_method" type="hidden" value="DELETE">
                     <button class="btn btn-danger btn-xs" onclick="return confirm ('Confirmar eliminación de registro')"><span class="glyphicon glyphicon-trash"></span></button>
                    </form>
                  </td>
                </tr>
                @endforeach 
                @else
                <tr>
                  <td colspan="8">¡No hay canastas!</td>
                </tr>
                @endif
              </tbody>
            </table>
            {!!$canastas->render()!!}
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
