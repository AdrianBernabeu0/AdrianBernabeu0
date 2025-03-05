@extends('layouts.master')

@section('title', 'Creacio Hotel Seeders')

@section('content')

    <div class="contenedorSeederHotel">
        <form action="{{ route('hotels.seederHotelStore') }}" method="post" class="formSeederHotel">
            @csrf

            <label class="labelSeederHotel" for="tipusHabitacions">Quantitat de tipus d'habitacions: </label>
            <input type="number" name="tipusHabitacions" id="tipusHabitacions" required>

            <label class="labelSeederHotel" for="habitacions">Habitacions per cada tipus d'habitacions: </label>
            <input type="number" name="habitacions" id="habitacions" required>

            <label class="labelSeederHotel" for="usuari">Vols crear un usuari recepcionista per l'hotel?</label>
            <div class="radioSeederHotel">
                <div>
                    <input type="radio" name="usuari" id="si" value="si" required>
                    <label for="si">Si</label>
                </div>
                <div>
                    <input type="radio" name="usuari" id="no" value="no" required>
                    <label for="no">No</label>
                </div>
            </div>
            <input type="hidden" name="paisNom" value="{{ $paisNom }}">
            <input type="hidden" name="ciutatNom" value="{{ $ciutatNom }}">
            <input type="hidden" name="hotelNom" value="{{ $hotelNom }}">
            <input type="hidden" name="hotelDireccio" value="{{ $hotelDireccio }}">
            <input type="hidden" name="hotelTelefon" value="{{ $hotelTelefon }}">
            <input type="hidden" name="hotelEmail" value="{{ $hotelEmail }}">
            <input type="hidden" name="hotelIdentificador" value="{{ $hotelIdentificador }}">
            <div class="contenedorBtnSeederHotel">
                <button class="btn-primary-seederHotel" type="submit">Enviar</button>
            </div>
    </div>
    </form>

@endsection
