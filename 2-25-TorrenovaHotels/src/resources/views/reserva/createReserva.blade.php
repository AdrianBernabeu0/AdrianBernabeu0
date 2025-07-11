@extends('layouts.master')

@section('title', content: 'Crear Reserva')

@section('content')
    <div class="contenedorForm">
        <form action="{{ route('reserva.store') }}" method="POST" id="formReserva" class="formReserva">
            @csrf
            <label for="dadesClient" class="labelStyle">Nom del client</label>
            <input type="text" name="dadesClient" id="dadesClient" class="inputStyle inputDisabled"
                value="{{ old('dadesClient', $nomUsuari) }}" readonly>
            @error('dadesClient')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <label for="habitacio" class="labelStyle">Habitació</label>
            @isset($habitacio)
                <input type="hidden" name="habitacio" id="habitacioId" value="{{ $habitacio->id }}">
                <input type="text" value="{{ $habitacio->nom }}" class="inputStyle inputDisabled" id="habitacioNom"
                    disabled>
            @else
                <select name="habitacio" id="habitacioSelect" class="inputStyle" required>
                    <option value="" selected disabled>-- Selecciona una habitació --</option>
                    @foreach ($habitacioFiltrar as $habitacio)
                        <option value="{{ $habitacio->idHabitacions }}">{{ $habitacio->NomHabitacions }}</option>
                    @endforeach
                </select>
                @error('habitacio')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            @endisset

            <label for="tipusHabitacio" class="labelStyle">Tipus Habitació</label>
            @isset($tipusHabitacions)
                <input type="hidden" name="tipusHabitacioNom" id="tipusHabitacioNom" value="{{ $tipusHabitacions->nom }}">
                <input type="hidden" name="tipusHabitacioPreu" id="tipusHabitacioPreu"
                    value="{{ $tipusHabitacions->preu_base }}">
                <input type="text" value="{{ $tipusHabitacions->nom }} -- {{ $tipusHabitacions->preu_base }} €"
                    class="inputStyle inputDisabled" disabled>
            @else
                <input type="hidden" name="tipusHabitacioNom" id="tipusHabitacioNom" value="">
                <input type="hidden" name="tipusHabitacioPreu" id="tipusHabitacioPreu" value="">
                <input type="text" name="tipusHabitacio" id="tipusHabitacio" class="inputStyle inputDisabled" readonly>
            @endisset
            @error('tipusHabitacioNom')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <label for="dataEntrada" class="labelStyle">Data Entrada</label>
            <input type="date" name="dataEntrada" id="dataEntrada" class="inputStyle"
                value="{{ old('dataEntrada', $fechaActual) }}" required>
            @error('dataEntrada')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <label for="dataSortida" class="labelStyle">Data Sortida</label>
            <input type="date" name="dataSortida" id="dataSortida" class="inputStyle"
                value="{{ old('dataSortida', $fechaSiguiente) }}" required>
            @error('dataSortida')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <label for="preu" class="labelStyle">Preu</label>
            <input type="number" name="preu" id="preu" class="inputStyle inputDisabled" readonly>
            @error('preu')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <p id="mensajeError" class="mensajeErrorReserva"></p>
            
            @isset($missatgeError)
                <p id="mensajeErrorServer" class="mensajeErrorReserva">{{ $missatgeError }}</p>
            @endisset

            <button type="submit" class="btnSubmit">Enviar</button>
        </form>
    </div>

    <script src="{{ asset('js/reserva.js') }}"></script>

@endsection
