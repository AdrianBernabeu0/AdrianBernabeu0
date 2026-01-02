@extends('layouts.master')

@section('title', 'Llistat Check-in')

@section('content')

<div class="containerForm">
    <div class="block">
        <h2>Filtrar per Data</h2>
        <form action="{{ route('rooms.search') }}" method="POST" id="formFiltrarData">
            @csrf
            <div class="containerDataClient">
            <div class="containerData">
              <label for="dataInici">Data entrada</label>
              <input type="date" name="dataInici" id="dataInici" value="{{ old('dataInici') }}" required>
  
              <label for="dataFinal">fins a</label>
              <input type="date" name="dataFinal" id="dataFinal" value="{{ old('dataFinal') }}" required>
            </div>
            <div class="containerClient">
              <label for="nomClient">Nom del client</label>
              <input type="text" name="nomClient" id="nomClient" value="{{ old('nomClient') }}" placeholder="Nom del client" required>
  
              <label for="numReserva">Número de reserva</label>
              <input type="text" name="numReserva" id="numReserva" value="{{ old('numReserva') }}" placeholder="Ex: Nº1" required>
            </div>
          </div>
          <div class="containerBtnCheckList">
            <button class="btn-primary-checkIn" type="submit">Enviar</button>
          </div>
        </form>
    </div>
</div>

<div id="contenedorHabitacions">
    @if ($habitacionsCheckIn && $habitacionsCheckIn->count() > 0)
        <div class="contenedorHabitacions">
            @foreach ($habitacionsCheckIn as $habitacio)
                <div class="contenedorHabitacion">
                    <p><strong>Identificador Reserva : </strong>{{ $habitacio->IdentificadorReserva }}</p>
                    <p><strong>Nom Usuari : </strong>{{ $habitacio->NomUsuari }}</p>
                    <p><strong>Data Reserva : </strong>{{ $habitacio->data_EntradaReservas }} -- {{ $habitacio->data_SortidaReservas }}</p>
                    <p><strong>Tipus Habitacio: </strong>{{ $habitacio->NomTipusHabitacions }}</p>
                    <p><strong>Ocupants Habitació : </strong>{{ $habitacio->OcupantsHabitacions }}</p>
                    <p><strong>Persones Reserva :</strong> {{ $habitacio->PersonesReserva }}</p>
                    <p><strong>Habitació Assignada: </strong> {{ $habitacio->NomHabitacions }}</p>
                    <p><strong>Estat Reserva :</strong> {{ $habitacio->EstatReservas }}</p>
                    <p><strong>Preu: </strong>{{ $habitacio->PreuReservas }}€</p>
                    <p><strong>Notes Client :</strong> {{ $habitacio->ObservacionHabitacions }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="no-reserves">No hi ha reserves</p>
    @endif
</div>

<template id="templateHabitacio">
    <div class="contenedorHabitacion">
        <p class="IdentificadorReserva"></p>
        <p class="NomUsuari"></p>
        <p class="data_EntradaReservas"></p>
        <p class="data_SortidaReservas"></p>
        <p class="NomTipusHabitacions"></p>
        <p class="OcupantsHabitacions"></p>
        <p class="PersonasReservas"></p>
        <p class="NomHabitacions"></p>
        <p class="EstatReservas"></p>
        <p class="PreuReservas"></p>
        <p class="NotasClient">Notes Client</p>
    </div>
</template>

<script src="{{ asset('js/checkIn.js') }}"></script>

@endsection
