@extends('layouts.master')

@section('title', 'Home')

@section('content')


{{-- Contenidor per quan hi hagi un missatge de success --}}
    @if (session('success'))
        <div class="contenedorSuccess" id="contenedorSuccess">
            <div class="success">
                <p>{{ session('success') }}</p>
                <button class="btnCerrarAlert" id="btnSuccess">X</button>
                </d>
            </div>
        </div>
    @endif
{{-- Missatge per cridar des de JS quan s'associa un usuari a un hotel --}}
<div id="mensaje-success" hidden>
</div>

<dialog class="dialog-home" id="modalHotel">
  <div class="close-dialog-roomManagement">
    <button class="btn-close-dialog-roomManagement" id="btnCloseDialog">X</button>
  </div>
  <h3 class="titleCrearUsuari">Crear Usuari</h3>

  <form action="{{ route('home.userSave') }}" method="POST" class="formCrearUsuari" id="formCrearUsuari">
    @csrf
    <div class="formLabelInputHome">
      <label for="nomUsuari" class="labelFormCrearUsuari">Nom d'Usuari</label>
      <input type="text" id="nomUsuari" name="nomUsuari" class="inputFormCrearUsuari" maxlength="255" required>
    </div>
  
    <div class="formLabelInputHome">
      <label for="contrasenyaUsuari" class="labelFormCrearUsuari">Contrasenya</label>
      <input type="password" id="contrasenyaUsuari" name="contrasenyaUsuari" class="inputFormCrearUsuari" maxlength="255" required>
    </div>

  <!-- error servidor -->
<div id="errorMessage">
<span id="errorText" class="textError"></span>
</div>

    <button type="submit" class="btnSubmitFormCrearUsuari">Crear Usuari</button>
  </form>
</dialog>

<div class="contenedorBtnHome">
    <a href="{{ route('hotels.create') }}" class="btn-primary">CREAR HOTEL</a>
    <a href="{{ route('rooms.checkInList') }}" class="check-in-link">Check-in habitacions</a>
</div>

@if ($hotels)
    <div class="contenedorHoteles">
        @foreach ($hotels as $hotel)
            <div class="contenedorHotel">
              <a href="{{route('hotelState', ['id' => $hotel->IdentificadorHotel]) }}">
                <img src="{{ asset('images/hotel.jpg') }}" alt="Logo" width="320px" height="150px">
            </a>
                <h3>{{ $hotel->nomHotel }}</h3>
                <p>{{ $hotel->direccio }}</p>
                <p>{{ $hotel->nomPais }}</p>
                <p>{{ $hotel->nomCiutat }}</p>
                <p>{{ $hotel->telefon }}</p>
                <p>{{ $hotel->email }}</p>
                  <div class="contenedorBtnHotel">
                    <button id="{{$hotel->IdentificadorHotel}}" class="btn-primary-crearUsuari">Crear usuari</button>
                  </div>
            </div>
        @endforeach
    </div>
@endif

<script src="{{asset('js/home.js')}}"></script>

@endsection
