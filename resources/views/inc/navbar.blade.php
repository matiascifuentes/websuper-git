 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    
      @if(Auth::check())
      <!-- ADMINISTRDOR -->
        @if(auth()->user()->tipo == 'administrador')
        <div class="navbar-header">
          <a class="navbar-brand main-title" href="{{ url('/administrador/home') }}">SuperWeb</a>
        </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('/administrador/home')}}">Panel</a></li>
            <li><a>Bienvenido: {{auth()->user()->email}}</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{route('productos.index')}}">Productos</a></li>
            <li><a href="{{route('canastas.index')}}">Canastas</a></li>
            <li><a href="{{route('prodCanasta-show')}}">Carro canasta</a></li>
            <li><a href="{{route('repartidores.index')}}">Repartidores</a></li>
            <li><a href="{{route('usuarios.index')}}">Clientes</a></li>
            <li><a href="{{route('entrega.index')}}">Entregas</a></li>

            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Informes</a>
              <ul class="dropdown-menu">
                <li><a href="{{url('/administrador/dynamic_pdf')}}">Informe Diario</a></li>
                <li><a href="">Informe Mensual</a></li>
              </ul>
            </li>
        @endif

      <!-- CLIENTE -->
        @if(auth()->user()->tipo == 'cliente')
          <div class="navbar-header">
            <a class="navbar-brand main-title" href="{{ route('home') }}">SuperWeb</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a>Bienvenido: {{auth()->user()->email}}</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('cart-show') }}"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
            <li><a href="{{ route('top-product') }}">Super Top <span class="glyphicon glyphicon-fire"></span></a></li>
            <li class="active"><a href="{{route('profile')}}">Mi Perfil</a></li>
          @endif
          
            <li><a href="{{route('logout')}}"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
      @else
        @if(Auth::guard('repartidores')->check())

        <!-- REPARTIDOR -->
          @if(Auth::guard('repartidores')->user()->tipo == 'repartidor')
            <div class="navbar-header">
              <a class="navbar-brand main-title" href="{{ url('/repartidor') }}">SuperWeb</a>
            </div>
            <ul class="nav navbar-nav">
              @if(Auth::guard('repartidores')->user()->disponibilidad == "Disponible")
                <span class="label label-success">
                  <i class="glyphicon glyphicon-ok-circle"></i>
                  DISPONIBLE
                </span>
              @else
                <span class="label label-default">
                  <i class="glyphicon glyphicon-ban-circle"></i>
                  NO DISPONIBLE
                </span>
              @endif
            </ul>
            <ul class="nav navbar-nav">
              <li><a>Bienvenido: {{Auth::guard('repartidores')->user()->email}}</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="#">Entregas</a></li>
              <li class="active"><a href="#">Mi Perfil</a></li>
              <li><a href="{{url('repartidores/logout')}}"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
          @endif
        @else
        <!-- SIN SESIÓN -->
          <ul class="nav navbar-nav navbar-right">
          <li><a href="{{route('register')}}"><span class="glyphicon glyphicon-user"></span>Registrarse</a></li>
          
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
              <span class="glyphicon glyphicon-log-in"> Login</span></a>
            <ul class="dropdown-menu">
              <li><a href="{{route('login')}}">Cliente</a></li>
              <li><a href="{{url('/repartidores/login')}}">Repartidor</a></li>                        
            </ul>
          </li>
        @endif
        
      @endif
     
       
    </ul>
  </div>
</nav> 