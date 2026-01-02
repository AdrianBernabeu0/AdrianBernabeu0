<?php
use App\Http\Middleware\RevisarRol;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\EstatHotelController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Les rutes us porten a la pantalla de creació d'hotel
Route::get('/hotels/create', [HotelController::class, 'create'])->name('hotels.create')->middleware(RevisarRol::class);

Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store')->middleware(RevisarRol::class);

Route::post('/hotels/seederHotel/store', [HotelController::class, 'seederHotelStore'])->name('hotels.seederHotelStore');

Route::get('/hotels/hotelState/{id?}', [EstatHotelController::class,'index'])->name('hotelState')->middleware(RevisarRol::class);

Route::get('/hotels/whitePage/{id}', function($id){return view('hotels.whitePage'
    ,["id",$id]);})->name('whitePage');

Route::post('/login/revision', [LoginController::class, 'login'])->name('loginStore');

Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware(RevisarRol::class);

Route::get('/rooms/checkinList', [RoomsController::class, 'show'])->name('rooms.checkInList')->middleware(RevisarRol::class);

Route::post('/rooms/checkinList/search', [RoomsController::class, 'search'])->name('rooms.search')->middleware(RevisarRol::class);

Route::post('/rooms/checkin', [RoomsController::class, 'checkin'])->name('rooms.checkin')->middleware(RevisarRol::class);

Route::get('/rooms/roomManagment', [RoomsController::class, 'roomManagment'])->name('hotels.roomManagment');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/room-management', [RoomsController::class, 'index'])->name('room.management');

Route::get('/reserva/createReserva', [ReservaController::class, 'index'])->name('reserva.createReserva');

Route::post('/reserva/store', [ReservaController::class, 'store'])->name('reserva.store');

