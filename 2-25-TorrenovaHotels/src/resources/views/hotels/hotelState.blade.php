@extends('layouts.master')

@section('title', 'Estat Hotels')

@section('content')

    <h1>Detalls de l'Hotel</h1>


    <div class="enllaçQuadreComandaments">
        <h2>Habitacions</h2>

        <p><strong>Fecha actual:</strong> {{ $fechaActual }}</p>
        <p><strong>Total de habitaciones:</strong> {{ $totalHabitaciones }}</p>
        <p><strong>Habitaciones libres:</strong> {{ $habitacionesLibres }} ({{ $porcentajeLibres }}%)</p>
        <p><strong>Habitaciones ocupadas:</strong> {{ $habitacionesOcupadas }} ({{ $porcentajeOcupacion }}%)</p>

    </div>
@endsection
