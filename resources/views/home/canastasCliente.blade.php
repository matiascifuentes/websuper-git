@extends('layouts.app')
@section('content')

<div class="panel-heading text-center" 
  style="font-size:30px;
        color:white;
        background:#e76114;
        margin-bottom:20px;">
    Canastas
</div>

<div class="container text-center">
  <div class="page">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered">
        <tr>
          <th style="text-align:center">Ver</th>
          <th style="text-align:center">Código</th> 
          <th style="text-align:center">Nombre</th>
          <th style="text-align:center">Descripción</th>
          <th style="text-align:center">Agregar</th>
        </tr>
        <tbody>
            @if($canastas->count())  
            @foreach($canastas as $canasta)  
              <tr>
                <td>
                  <a class="btn btn-info btn-xm" href="{{route('show-canasta',$canasta->id)}}">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </a>
                </td>
                <td>{{$canasta->id}}</td>
                <td>{{$canasta->nombre}}</td>
                <td>{{$canasta->descripcion}}</td>
                <td>
                  <a class="btn btn-warning btn-xm" href="{{route('canasta-add',$canasta->id)}}">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                  </a>
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


@endsection
