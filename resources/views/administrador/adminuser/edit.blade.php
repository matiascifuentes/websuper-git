@extends('layouts.app')
@section('content')
<div class="row">
  <section class="content">
    <div class="col-md-8 col-md-offset-2">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Error!</strong> Revise los campos obligatorios.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      @if(Session::has('success'))
      <div class="alert alert-info">
        {{Session::get('success')}}
      </div>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Actualizar Estado de Cliente</h3>
        </div>
        <div class="panel-body">          
          <div class="table-container">
            <form method="POST" action="{{ route('usuarios.update',$usuarios->id)  }}"  role="form">
              {{ csrf_field() }}
              <input name="_method" type="hidden" value="PATCH">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">

                  <label for="name" class="col-xs-12 col-sm-12 col-md-12">{{ __('Nombre') }}</label>

                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$usuarios->name}}" readonly="readonly">
                  </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">

                  <label for="city" class="col-xs-12 col-sm-12 col-md-12">{{ __('Ciudad') }}</label>

                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <input id="city" type="text" class="form-control" name="city" value="{{$usuarios->city}}" readonly="readonly">
                  </div>

                </div>

                  <div class="col-xs-12 col-sm-12 col-md-12">

                  <label for="address" class="col-xs-12 col-sm-12 col-md-12">{{ __('Direccion') }}</label>

                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <input id="address" type="text" class="form-control" name="address" value="{{$usuarios->address}}" readonly="readonly">
                  </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">

                  <label for="region" class="col-xs-12 col-sm-12 col-md-12">{{ __('Region') }}</label>
                   <div class="col-xs-12 col-sm-12 col-md-12">
                      <input  class="form-control" name="region" id="region" value="{{$usuarios->region}}" readonly="readonly">
                  </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">

                  <label for="name" class="col-xs-12 col-sm-12 col-md-12">{{ __('Teléfono') }}</label>

                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <input id="name" type="text" class="form-control" name="name" value="{{$usuarios->phone}}" readonly="readonly">
                  </div>

                </div>

              <div class="col-xs-12 col-sm-12 col-md-12">

                  <label for="tipo" class="col-xs-12 col-sm-12 col-md-12">{{ __('Tipo') }}</label>

                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <select class="form-control" name="tipo" id="tipo" value="{{$usuarios->tipo}}">
                          <!-- <option selected="selected" hidden>{{ auth()->user()->region}}</option> -->
                          <option value="Desactivado">Desactivado</option>
                          <option value="cliente">Cliente</option>
                      </select>
                  </div>

                </div>

              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                  <input type="submit"  value="Actualizar" class="btn btn-success btn-block">
                  <a href="{{ route('usuarios.index') }}" class="btn btn-info btn-block" >Cancelar</a>
                </div>  
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>
@endsection