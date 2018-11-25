@extends('layouts.app')
@section('content')

@if(Session::has('success'))
  <div class="alert alert-info">
    {{Session::get('success')}}
  </div>
@endif

<div>
  <span class="glyphicon glyphicon-chevron-left"></span>
  <a class="btn btn-warning" href="{{url('/administrador/home') }}">Volver</a>
  <hr>
</div>

  <div class="container">
   <h3 align="center">Reparto diario</h3><br />
   
   <div class="row">
    <div class="col-md-7" align="right">
     <h4>Informe de entregas al día - {{ $date }}</h4> 
    </div>
    <div class="col-md-5" align="right">
     <a href="{{ url('administrador/info_reparto_diario/pdf_entregadia') }}" class="btn btn-danger">Convertir a PDF</a>
    </div>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <thead>
      <tr>
       <th>ID</th>
       <th>Nombre</th>
       <th>Cantidad entregas</th>
       <th>Total</th>
      </tr>
     </thead>
     <tbody>
     @foreach($rep_data as $rep)
      <tr>
        <td>{{ $rep->rep_id }}</td>
        <td>{{ $rep->rep_name }}</td>
        <td>{{ $rep->cantidad_ventas }}</td>
        <td>${{ $rep->total_ventas }}</td>
      </tr>
     @endforeach
     </tbody>
    </table>
   </div>
  </div>
@endsection
