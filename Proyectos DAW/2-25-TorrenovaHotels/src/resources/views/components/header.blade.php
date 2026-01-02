
{{-- Creació de component de l'header perquè pugui ser cridat a les pantalles
necessàries. Amb el vostre logotip el vostre navegador i el vostre botó d'iniciar sessió. --}}


<header>
    <div class="contenedorLogo">
        <a href="{{route('home')}}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="100px" height="100px">
        </a>
    </div>
    <h2>
      Torrenova
    </h2>
    
    @if (Auth::user())
        <div class="contenedorLogin">
          <p>{{Auth::user()->name}}</p>
          <div class="flecheta-icon"></div>
        </div>
          <a href="{{route("logout")}}" class="divLogout">
            <div class="btnLogout">
            Log Out
            </div>
          </a>
    @else
    <div class="contenedorLogin">
      <a href="{{route('login')}}">
        <img src="{{asset('images/user.png')}}" alt="User" width="55px" height="55px">
      </a>
    </div>
    @endif
</header>
