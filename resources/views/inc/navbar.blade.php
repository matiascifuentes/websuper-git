 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    
      @if(Auth::check())
      <!-- ADMINISTRDOR -->
        @if(auth()->user()->tipo == 'administrador')
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ url('/administrador/home') }}">
            <img src="{{ asset ('img/superweb.png')}}" alt="">
          </a>
        </div>
          <ul class="nav navbar-nav">
            <li><a>Bienvenido: {{auth()->user()->email}}</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{url('/administrador/home')}}">Panel</a></li>
            <li><a href="{{route('prodCanasta-show')}}">Carro canasta<span class="glyphicon glyphicon-shopping-cart"></span></a></li>
        @endif

      <!-- CLIENTE -->
        @if(auth()->user()->tipo == 'cliente')
          <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">
              <img alt="Brand" src="{{ asset('img/superweb.png') }}">
            </a>
          </div>
          <ul class="nav navbar-nav">
            <li><a>Bienvenido: {{auth()->user()->email}}</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{route('profile')}}" style="margin-left:10px; margin-right:10px;">Mi Perfil</a></li>
            <li><a href="{{ route('h-compras') }}" style="margin-left:10px; margin-right:10px;">Mis compras</a></li>
            <li><a href="{{ route('top-product') }}" style="margin-left:10px; margin-right:10px;"><span class="glyphicon glyphicon-star"></span>Super Top </a></li>
            <li><a href="{{ route('cart-show') }}"><span class="glyphicon glyphicon-shopping-cart" style="margin-left:10px; margin-right:10px;"></span></a></li>
          @endif
          
            <li><a href="{{route('logout')}}"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
      @else
        @if(Auth::guard('repartidores')->check())

        <!-- REPARTIDOR -->
          @if(Auth::guard('repartidores')->user()->tipo == 'repartidor')
            <div class="navbar-header">
              <a class="navbar-brand main-title" href="{{ url('/repartidor') }}">
                  <img src="{{ asset ('img/superweb.png')}}" alt="">
              </a>
            </div>
            <ul class="nav navbar-nav" style="margin-top: 35px;">
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
              <li><a href="{{ url('/repartidor') }}">Entregas</a></li>
              <li><a href="#">Mi Perfil</a></li>
              <li><a href="{{ route('h-entregados') }}">Mis Entregados</a></li>
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