@extends('layouts.master')

@section('title', 'Room Management')

@section('content')

{{-- Missatge per error en servidor --}}
@if (session('error'))
<div class="contenedorSuccess" id="contenedorSuccess">
  <div class="error">
    {{ session('error') }}
    <button class="btnCerrarAlert" id="btnSuccess">X</button>
  </div>
</div>
@endif
{{-- Missatge per success en servidor --}}
    @if (session('success'))
        <div class="contenedorSuccess" id="contenedorSuccess">
            <div class="success">
                {{ session('success') }}
                <button class="btnCerrarAlert" id="btnSuccess">X</button>
            </div>
        </div>
    @endif

    <dialog class="dialog-roomManagment" id="dialog-roomManagment">
        <div class="close-dialog-roomManagement">
            <button class="btn-close-dialog-roomManagement">X</button>
        </div>
        <h3 class="div-check-titol">Detall de l'habitació</h3>
        <form action="{{ route('rooms.roomBlock') }}" id="formRoomBlock" method="POST">
            <button type="submit" class="btn-primary-roomBlock roomBlock">Bloquejar habitació</button>
            <button type="submit" class="btn-primary-roomBlock roomBlock">Bloquejar habitació</button>
        </form>
        <form action="{{ route('reserva.createReserva') }}" id="formCreateReserva" method="GET">
            <input type="hidden" class="btnCreateReserva" name="idHabitacion" value="">
            <input type="hidden" class="btnCreateReservatipusHabitacio" name="nomTipushabitacio" value="">
            <button id="btnCrearReserva" type="submit">Crear Reserva</button>
            <div class="contenedorBtnReserva">
    </form>
    
        </form>
        <div class="div-dialog-roomManagment">
            <h4>Estat de l'habitació: </h4>
        <div class="div-dialog-estat-habitacio"></div>
        <h4>Persones que pot tenir l'habitació:</h4>
        <div class="div-dialog-num-habitacio"></div>
        <h4>Serveis: </h4>
        <div class="div-dialog-serveis-habitacio"></div>
        <h4>Tipus Habitació:</h4>
        <div class="div-dialog-tipus-habitacio"></div>
        <div class="div-dialog-reserva-habitacio"></div>
        </div>
        <div class="div-check-btn" id="divCheckBtn">
            <form action="{{ route('rooms.checkin') }}" id="formCheckIn" method="POST">
                @csrf
                <button type="submit" class="btn-primary-checkIn checkIn" name="id">Check-in</button>
            </form>
            <form action="{{ route('rooms.checkin') }}" id="formCheckOut" method="POST">
                @csrf
                <button type="submit" class="btn-primary-checkOut checkOut">Check-out</button>
            </form>
        </div>
    </dialog>
    <dialog class="dialog-roomManagment" id="dialog-detall-reserva">
        <div class="close-dialog-roomManagement">
            <button class="btn-close-dialog-roomManagement" id="btn-close-dialog-detall-reserva">X</button>
        </div>
        <h3 class="div-check-titol">Detall de la Reserva</h3>
        <div class="div-detall-reserva">
        <h4>Data Entrada: </h4>
        <div class="div-detall-reserva-data-entrada"></div>
        <h4>Data Sortida:</h4>
        <div class="div-detall-reserva-data-sortida"></div>
        <h4>Nom</h4>
        <div class="div-detall-reserva-nom"></div>
        <h4>Email</h4>
        <div class="div-detall-reserva-email"></div>
        <h4>Preu reserva:</h4>
        <div class="div-detall-reserva-preu"></div>
        </div>
    </dialog>
    <div class="contenedorBtnReserva">
      <form action="{{ route('reserva.createReserva') }}" method="GET">
        <button type="submit" class="btnCrearReservaRoomManagment">Crear Reserva</button>
      </form>
    </div>
    <div class="logoutRoomManagment">
      <form action="{{ route('logout') }}" method="GET">
        <button type="submit" class="btnLogoutRoomManagment">Log out</button>
      </form>
    </div>
    

    <div class="container-roomManagment">
    <div class="calendar-container" id="calendar-container">
            <div class="container-btn-left">
                <button id="prev-button" class="btn btn-secondary btn-actualitza-calendari"><</button>
            </div>
        <div class="dies">
            @foreach ($diasCalendari as $day)
                <div class="days" data-date="{{ $day['date'] }}">
                    {{ $day['day'] }}
                    {{ $day['month'] }}
                </div>
            @endforeach
        </div>
        <div class="container-btn-right">
            <button id="next-button" class="btn btn-secondary btn-actualitza-calendari">></button>
        </div>
        <div class="habitacions">
            @foreach ($habitacions as $habitacio)
                <div class="habitacion" id="{{ $habitacio->idHabitacions }}">{{ $habitacio->NomHabitacions }}</div>
            @endforeach
        </div>
        <div class="totesReserves truncate-text">
        </div>
    </div>
    </div>
    <script src="{{ asset('js/roomManagment.js') }}"></script>
@endsection