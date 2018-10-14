@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger" role="alert">
                <strong>¡Ha ocurrido un error!</strong> Acceso denegado.
            </div>
                <h3>Actualmente usted no forma parte de nuestro equipo de repartidores.</h3>
                <h5>Si esto es una equivocación le solicitamos ponerse en contacto con el administrador.</h5>
            </div>
    </div>
    <p>
		<a class="btn btn-success" href="{{ url('repartidores/login') }}">Ir al login</a>
	</p>
</div>
@endsection
