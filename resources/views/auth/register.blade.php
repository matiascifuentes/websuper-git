@extends('layouts.app')

@section('content')
<div class="back-registro">
    <h1 class="text-center">Registrate Para Una Mejor Experiencia</h1>
    <div class="registro">
        <form method="POST" action="{{ route('register') }}" class="form-registro">
            @csrf
            <h2 class="form_titulo">Registro de Usuario</h2>
            <div class="contenedor-inputs">
                <div class="registro-input-100">     
                    <input id="name" type="text" placeholder="Nombre Completo" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" autofocus required>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="registro-input-100">                  
                    <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="registro-input-48">
                    <select class="form-control {{ $errors->has('region') ? ' is-invalid' : '' }}" name="region" id="region">
                        <option value="" disabled selected>---Selecione una Region---</option> 
                        <option value="Arica y Parinacota">Arica y Parinacota</option>
                        <option value="Región de Tarapacá">Región de Tarapacá</option>
                        <option value="Región de Antofagasta">Región de Antofagasta</option>
                        <option value="Región de Atacama">Región de Atacama</option>
                        <option value="Región de Coquimbo">Región de Coquimbo</option>
                        <option value="Región de Valparaíso">Región de Valparaíso</option>
                        <option value="Región de O'Higgins">Región de O'Higgins</option>
                         <option value="Región del Maule">Región del Maule</option>
                        <option value="Región de Ñuble">Región de Ñuble</option>
                        <option value="Región del Biobío">Región del Biobío</option>
                        <option value="Región La Araucanía">Región La Araucanía</option>
                        <option value="Región de Los Ríos">Región de Los Ríos  </option>
                        <option value="Región de Los Lago">Región de Los Lagos </option>
                        <option value="Región de Aysén">Región de Aysén</option>
                        <option value="Region Metropolitana">Region Metropolitana</option>
                        <option value="Region de Magallanes">Region de Magallanes</option>
                    </select>
            
                     @if ($errors->has('region'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('region') }}</strong>
                        </span>
                    @endif
                 </div>                 


                <div class="registro-input-48">
                    <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" placeholder ="Ciudad" name="city" value="{{ old('city') }}" autofocus>

                    @if ($errors->has('city'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="registro-input-100">
                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder ="Dirección" name="address" value="{{ old('address') }}">

                    @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="registro-input-100">
                    <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder ="Numero de Celular"name="phone" value="{{ old('phone') }}">

                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="registro-input-48">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder ="Contraseña" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="registro-input-48">
                    <input id="password-confirm" type="password" class="form-control" placeholder ="Repetir Contraseña" name="password_confirmation" required>
                </div>     
                <input type="submit" value="Registrate" class="btn-enviar">
                <p class="form-link">¿Ya tienes una cuenta? <a href="{{ route('home') }}">Ingresa aquí</a></p>
            </div>
        </form>
    </div>
</div>

@endsection
