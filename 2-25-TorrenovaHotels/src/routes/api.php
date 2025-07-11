<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\Api\ReservaApiController;
use App\Http\Controllers\Api\HabitacionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/home/usuariHotel', [HomeController::class, 'assignarUsuariHotel'])->name('home.userSave');

Route::get('/rooms/detail/{id?}', [RoomsController::class, 'showDetallHabitacion'])->name('rooms.detailsRooms');

Route::get('/rooms/detail/reserva/{id?}', [RoomsController::class, 'showDetallReserva'])->name('rooms.detailsReserva');

Route::post('/rooms/detail/checkIn', [RoomsController::class, 'checkIn'])->name('rooms.checkin');

Route::post('/rooms/detail/checkOut', [RoomsController::class, 'checkOut'])->name('rooms.checkout');

Route::post('/rooms/detail/reserves', [RoomsController::class, 'showReserves'])->name('rooms.reserves');

Route::post('/rooms/checkinList/search', [RoomsController::class, 'search'])->name(name: 'rooms.search');

Route::post('/rooms/detail/roomBlock', [RoomsController::class, 'roomBlock'])->name('rooms.roomBlock');

Route::post('/reserva/getTipusHabitacio', [ReservaController::class, 'getTipusHabitacio'])->name('reserva.getTipusHabitacio');

Route::get('/habitaciones', [HabitacionController::class, 'index']);

Route::post('/actualitzarReservas', [ReservaApiController::class, 'index']);