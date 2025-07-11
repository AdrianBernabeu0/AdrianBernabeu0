@extends('layouts.master')

@section('title', 'login')

@section('content')
    <div class="login-container">
        <div class="form-container">
            <h1>Iniciar sessió</h1>
            <div id="feedback"></div>
            <form action="{{ route('loginStore') }}" id="login-form" method="POST">
                @csrf
                <div class="input-container">
                    <input type="text" id="user" placeholder="Usuari" name="name" required>
                </div>
                <div class="input-container">
                    <input type="password" id="password" placeholder="Contrasenya" name="password" required>
                </div>
                <button type="submit" class="create-user-btn">Login</button>
            </form>
            <div>
                @if (session('error'))
                    <p class="errorP">{{ session('error') }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
