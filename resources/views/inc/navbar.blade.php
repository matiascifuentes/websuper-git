 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand main-title" href="{{ route('home') }}">SuperWeb</a>
    </div>
   
      @if(Auth::check())
        @if(auth()->user()->tipo == 'administrador')
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
        @endif
        @if(auth()->user()->tipo == 'cliente')
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
        <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
        <li><a href="{{route('register')}}"><span class="glyphicon glyphicon-user"></span>Registrarse</a></li>
        <li><a href="{{route('login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      @endif
    </ul>
  </div>
</nav> 