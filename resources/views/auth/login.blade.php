@extends('layouts.app')

@section('content')
<div class="fondo">
    <div class="login">
        <form method="POST" action="{{ route('login') }}" class="form-login">
            @csrf
            <h2>Bienvenido Cliente</h2>
            <div class="input-login">
                <input id="email" type="email" placeholder="&#128272; Ingrese tu Correo" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="input-login">
                <input id="password" type="password" placeholder="&#128272; Ingrese tu Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="input-login">
                <input type="submit" value="Ingresar">
            </div>

        </form>
    </div>
</div>
@endsection
