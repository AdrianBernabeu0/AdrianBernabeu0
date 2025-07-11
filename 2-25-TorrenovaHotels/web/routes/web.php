<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/roomAvailable', function () {
    return view('roomAvailable');
});

Route::get('/roomAvailable', function () {
    return view('roomAvailable');
});

Route::get('/politica', function () {
    return view('politica');
});

Route::get('/condicions', function () {
    return view('condicions');
});

Route::get('/nosaltres', function () {
    return view('nosaltres');
});

Route::get('/resumReserva', function(){
  return view('resumReserva');
})->name('resumReserva');

Route::get('/reserva', function () {
    return view('reserva');
});