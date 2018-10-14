@extends('layouts.app')
@section('content')


<div class="container text-center">
	{{Auth::guard('repartidores')->user()->tipo}}
	{{Auth::guard('repartidores')->user()->correo}}
	{{Auth::guard('repartidores')->user()->id}}
	AREA DE REPARTIDOR
</div>

@endsection