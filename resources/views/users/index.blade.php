

@extends("layouts.app")

@section("content")
<div class="form-group">
  <div class="col-sm-12">
      <h3 class="text-center">Mi perfil</span></h3>
  </div>
</div>
@if (session('success'))
  <div class="alert alert-success col-sm-12">
      <h5 class="text-center">{{ session('success') }}</h5>
  </div>

@endif

@if (session('error'))
  <div class="alert alert-danger">
      {{ session('error') }}
  </div>

@endif
<form action="{{ route('profile.update') }}" method="POST">
{!! csrf_field() !!}
  <div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ auth()->user()->name }}">

        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
  </div>

  <div class="form-group row">
        <label for="region" class="col-md-4 col-form-label text-md-right">{{ __('Region') }}</label>

        <div class="col-md-6">
            <select class="form-control {{ $errors->has('region') ? ' is-invalid' : '' }}" name="region" id="region" value="{{ auth()->user()->region}}">
                <!-- <option selected="selected" hidden>{{ auth()->user()->region}}</option> -->
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
    </div>

   <div class="form-group row">
        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad') }}</label>

        <div class="col-md-6">
            <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ auth()->user()->city}}" autofocus>

            @if ($errors->has('city'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ auth()->user()->address}}">

            @if ($errors->has('address'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
        </div>
    </div>
  
    <div class="form-group row">
        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

        <div class="col-md-6">
            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ auth()->user()->phone}}">

            @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>
  <div class="form-group row mb-0">
      <div class="col-md-6 offset-md-4">
          <button type="submit" class="btn btn-primary">
              {{ __('Actualizar') }}
          </button>
      </div>
  </div>
</form>


@endsection