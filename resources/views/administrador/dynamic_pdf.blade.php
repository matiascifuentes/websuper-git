@extends('layouts.app')
@section('content')

@if(Session::has('success'))
  <div class="alert alert-info">
    {{Session::get('success')}}
  </div>
@endif

  <div class="container">
   <h3 align="center">Ventas diarias</h3><br />
   
   <div class="row">
    <div class="col-md-7" align="right">
     <h4>Informe de ventas del día {{ $date->format('Y-m-d') }}</h4> 
    </div>
    <div class="col-md-5" align="right">
     <a href="{{ url('administrador/dynamic_pdf/pdf') }}" class="btn btn-danger">Convertir a PDF</a>
    </div>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <thead>
      <tr>
       <th>Id Venta</th>
       <th>Total</th>
      </tr>
     </thead>
     <tbody>
     @foreach($pedido_data as $customer)

      <tr>
       <td>{{ $customer->id }}</td>
       <td>{{ $customer->subtotal }}</td>
      </tr>
     @endforeach
     </tbody>
    </table>
   </div>
  </div>
@endsection
