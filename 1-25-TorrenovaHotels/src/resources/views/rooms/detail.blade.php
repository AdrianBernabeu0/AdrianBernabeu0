@extends('layouts.master')

@section('title', 'Detalls habitacións')

@section('content')


{{-- @dd($habitacion) --}}
<div class="div-check-container">
    <h3 class="div-check-titol">Detall de l'habitació</h3>

    <ul class="div-check-details">
        <li><strong>Estat de l'habitació</strong></li>
        <p id="estatHabitacion">{{$habitacion[0]->Estat_habitacion}}</p>
        <li><strong>Persones que pot tenir l'habitació</strong></li>
        <p>{{$habitacion[0]->Nombre_llits}}</p>
        <li><strong>Serveis</strong></li>
        <p>{{$habitacion[0]->Nom_servei}}</p>
        @if($habitacion[0] -> Identificador_reserva)
            <h3>Reserva actual</h3>
            <li><strong>Nom client</strong></li>
            <p>{{$habitacion[0]->Identificador_client}}</p>
            <li><strong>ID Reserva</strong></li>
            <p>{{$habitacion[0]->Identificador_reserva}}</p>
        @else
            <p>No hi ha reserves actualment.</p>
        @endif
    </ul>
    <div class="div-check-btn">
        <form action="{{route('rooms.checkin')}}" id="formCheckIn" method="POST">
            @csrf
            <button type="submit" class="btn-primary-checkIn checkIn" id="{{$habitacion[0]->Identificador_reserva}}" name="id">Check-in</button>
        </form>
        <form action="{{route('rooms.checkin')}}" id="formCheckOut" method="POST">
            @csrf
            <button type="submit" class="btn-primary-checkOut checkOut" id="{{$habitacion[0]->Identificador_reserva}}">Check-out</button>
        </form>
    </div>
</div>
<script src="{{ asset('js/roomDetails.js') }}" ></script>
@endsection
