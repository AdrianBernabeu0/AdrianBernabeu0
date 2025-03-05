<?php

use App\Mail\PagoSimulado;
use App\Mail\CustomMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/message/{lang?}', function ($lang) {
  App::setLocale($lang);

  $message = trans('messages');

  return response()->json([
      'message' => $message,
  ]);
});
Route::post('/correo-enviar', function (Request $request) {

  $datos = $request->all();

  Mail::to('prueba@example.com')->send(new PagoSimulado($datos));

  
  return response()->json(['message' => 'Correu enviat amb èxit.']);
});

Route::post('/correo-mail', function (Request $request) {
  $mail = $request->all();

  Mail::to($mail)->send(new CustomMailable());

  
  return response()->json(['message' => 'Correu enviat amb èxit.']);
});