@extends('layouts.master')

@section('title', 'Creacio Hotels')

@section('content')

    <div class="container">

        <form action="{{ route('hotels.store') }}" method="POST" id="formHotel">

            <div>
                {{-- validacion error js --}}
                <p id="error"></p>
                {{-- validacion error php --}}
                @if ($errors->any())
                    <div>

                        @foreach ($errors->all() as $error)
                            <p class="error">{{ $error }}</p>
                        @endforeach

                    </div>
                @endif
            </div>
            @csrf
            <div class="input-field">
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Nom de l'hotel *" required>
            </div>

            <div>
                <input type="text" name="direccio" id="direccio" value="{{ old('direccio') }}"  placeholder="Direcció de l'hotel *" required>
            </div>

            <div>
                <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat') }}" placeholder="Ciutat de l'hotel *" required>
            </div>

            <div>
                <input type="text" name="pais" id="pais" value="{{ old('pais') }}" placeholder="País de l'hotel *" required>
            </div>

            <div>
                <input type="tel" name="telefon" id="telefon" value="{{ old('telefon') }}" placeholder="Telèfon *" maxlength="9" required>
            </div>

            <div>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email *" required>
            </div>
            <div>
                <input type="text" id="identificadorHotel" name="identificadorHotel"
                    value="{{ old('identificadorHotel') }}" placeholder="Identificador de l'hotel *" required>
            </div>

            <button>Enviar Hotel</button>
            <a href="{{ route('home') }}" class="back-home">Tornar a l'inici</a>
        </form>

        <div class="image-container">
            <img src="{{ asset('images/formulari.png') }}" alt="">
        </div>

    </div>
    <script src="{{ asset('js/createHotel.js') }}" type="module"></script>
@endsection
