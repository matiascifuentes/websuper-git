@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger" role="alert">
                <strong>¡Ha ocurrido un error!</strong> Acceso denegado.
            </div>
                <h3>Actualmente su cuenta se encuentra bloqueada por el administrador.</h3>
                <h5>Si esto es una equivocación le solicitamos ponerse en contacto.</h5>
            </div>
    </div>
    <p>
		<a class="btn btn-success" href="{{ route('login') }}">Ir al login</a>
	</p>
</div>
@endsection
