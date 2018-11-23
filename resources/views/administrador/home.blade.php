@extends('layouts.app')
@section('content')

<div class="alert alert-success">
  <strong>Bienvenido(a)</strong> {{auth()->user()->email}}
</div>

<ul class="nav nav-pills">
  <li class="active"><a data-toggle="pill" href="#panel-admin">Panel de administración</a></li>
  <li><a data-toggle="pill" href="#informes-admin">Informes</a></li>
</ul>

<br>
<div class="tab-content">
	<div id="panel-admin" class="tab-pane fade in active">
		<!-- PANEL DE ADMINISTRACIÓN -->
		<div class="container">
		    <div class="row">
		        <div class="col-md-12">
		            <div class="panel panel-primary">
		                <div class="panel-heading">
		                    <h3 class="panel-title">
		                        <span class="glyphicon glyphicon-paperclip"></span> Panel de administración</h3>
		                </div>
		                <span class="glyphicon glyphicon-user"> {{auth()->user()->name}}</span>
		                <label></label>
		                <span class="glyphicon glyphicon-globe"> {{auth()->user()->email}}</span>
		                <div class="panel-body">
		                    <div class="row">

		                    	<div class="col-lg-3">
							        <div class="panel panel-danger">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-users fa-5x"></i>
							              </div>
							              <div class="col-xs-6 text-right">
							                <p class="announcement-text">Clientes</p>
							              </div>
							            </div>
							          </div>
							          <a href="{{route('usuarios.index')}}">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                  Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
							    </div>

		                        <div class="col-lg-3">
							        <div class="panel panel-info">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-street-view fa-5x"></i>
							              </div>
							              <div class="col-xs-6 text-right">
							                <p class="announcement-text">Repartidores</p>
							              </div>
							            </div>
							          </div>
							          <a href="{{route('repartidores.index')}}">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                  Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
							      </div>

							      <div class="col-lg-3">
							        <div class="panel panel-warning">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-barcode fa-5x"></i>
							              </div>
							              <div class="col-xs-6 text-right">
							                <p class="announcement-text"> Productos</p>
							              </div>
							            </div>
							          </div>
							          <a href="{{route('productos.index')}}">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                  Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
							      </div>

							      <div class="col-lg-3">
							        <div class="panel panel-success">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-truck fa-5x"></i>
							              </div>
							              <div class="col-xs-6 text-right">
							                <p class="announcement-text">Entregas</p>
							              </div>
							            </div>
							          </div>
							          <a href="{{route('entrega.index')}}">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                  Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
							      </div>

							      <div class="col-lg-3">
							        <div class="panel panel-success">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-archive fa-5x"></i>
							              </div>
							              <div class="col-xs-6 text-right">
							                <p class="announcement-text">Canastas</p>
							              </div>
							            </div>
							          </div>
							          <a href="{{route('canastas.index')}}">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                  Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
		     					</div>
		                    	<div class="col-lg-3">
							        <div class="panel panel-warning">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-list-alt fa-5x"></i>
							              </div>
							              <div class="col-xs-6 text-right">
							                <p class="announcement-text">Pedidos</p>
							              </div>
							            </div>
							          </div>
							          <a href="{{ route('h-pedidos')}}">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                  Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
							    </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	<!-- FIN PANEL DE ADMINISTRACIÓN -->
	</div>

	<div id="informes-admin" class="tab-pane fade">
		<!-- INFORMES -->
		<div class="container">
		    <div class="row">
		        <div class="col-md-12">
		            <div class="panel panel-primary">
		                <div class="panel-heading">
		                    <h3 class="panel-title">
		                        <span class="glyphicon glyphicon-list-alt"></span> Informes</h3>
		                </div>
		                <div class="panel-body">
		                    <div class="row">
		                    	
			                    <div class="col-lg-3">
							        <div class="panel panel-info">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-thumb-tack fa-2x"></i>
							              </div>
							            </div>
							            <div class="row">
							            	<div class="col-xs-12 text-center">
							                <p class="announcement-text">Ventas diarias</p>
							              </div>
							            </div>
							          </div>
							          <a href="{{url('/administrador/dynamic_pdf')}}">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                 Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
								</div>

								<div class="col-lg-3">
							        <div class="panel panel-info">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-thumb-tack fa-2x"></i>
							              </div>
							            </div>
							            <div class="row">
							            	<div class="col-xs-12 text-center">
							                <p class="announcement-text">Ventas mensuales</p>
							              </div>
							            </div>
							          </div>
							          <a href="{{url('/administrador/info_mes')}}">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                 Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
								</div>

								<div class="col-lg-3">
							        <div class="panel panel-info">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-thumb-tack fa-2x"></i>
							              </div>
							            </div>
							            <div class="row">
							            	<div class="col-xs-12 text-center">
							                <p class="announcement-text">Entregas diarias</p>
							              </div>
							            </div>
							          </div>
							          <a href="#">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                 Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
								</div>

								<div class="col-lg-3">
							        <div class="panel panel-info">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-thumb-tack fa-2x"></i>
							              </div>
							            </div>
							            <div class="row">
							            	<div class="col-xs-12 text-center">
							                <p class="announcement-text">Entregas mensual</p>
							              </div>
							            </div>
							          </div>
							          <a href="{{url('/administrador/info_reparto_mes')}}">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                 Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
								</div>

								<div class="col-lg-3">
							        <div class="panel panel-info">
							          <div class="panel-heading">
							            <div class="row">
							              <div class="col-xs-6">
							                <i class="fa fa-thumb-tack fa-2x"></i>
							              </div>
							            </div>
							            <div class="row">
							            	<div class="col-xs-12 text-center">
							                <p class="announcement-text">Origen de compras</p>
							              </div>
							            </div>
							          </div>
							          <a href="#">
							            <div class="panel-footer announcement-bottom">
							              <div class="row">
							                <div class="col-xs-6">
							                 Ir
							                </div>
							                <div class="col-xs-6 text-right">
							                  <i class="fa fa-arrow-circle-right"></i>
							                </div>
							              </div>
							            </div>
							          </a>
							        </div>
								</div>

		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	<!-- FIN INFORMES -->
	</div>

	<div id="menu2" class="tab-pane fade">
		<h3>Menu 2</h3>
		<p>Some content in menu 2.</p>
	</div>
</div>


@endsection