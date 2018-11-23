@extends('layouts.app')
@section('content')

@if(Session::has('success'))
  <div class="alert alert-info">
    {{Session::get('success')}}
  </div>
@endif

  <div class="container">
   <h3 align="center">Ventas Mensuales por region</h3><br />
   
   <div class="row">
    <div class="col-md-7" align="right">
     <h4>Informe de ventas del mes:  {{ $date }}</h4> 
    </div>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <thead>
      <tr>
       <th>Region</th>
       <th>Cantidad de conecciones</th>
       <th>Total venta mensual</th>
      </tr>
     </thead>
     <tbody>
     @foreach($regi_data as $reg)
      <tr>
        <td>{{ $reg->region_nom }}</td>
        <td>{{ $reg->cantidad_pedidos }}</td>
        <td>${{ $reg->total_ventas }}</td>
      </tr>
     @endforeach
     </tbody>
    </table>
   </div>
  </div>
@endsection
