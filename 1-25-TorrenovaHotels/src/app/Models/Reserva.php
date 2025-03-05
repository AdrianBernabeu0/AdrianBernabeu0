<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reserva extends Model
{
  use HasFactory;
  protected $fillable = [
    "data_Entrada",
    "data_Sortida",
    "check_in",
    "check_out",
    "persones_reserva",
  ];

  public static function getReservaCheckIn()
  {
    $hoy = date('Y-m-d');
    $hotels = DB::table('reservas')
      ->join('habitacions', 'habitacions.id', '=', 'reservas.habitacion_id')
      ->join('tipus_habitacions', 'tipus_habitacions.id', '=', 'tipus_habitacions_id')
      ->join('users', 'users.id', '=', 'usuari_id')
      ->whereDate('reservas.data_Entrada', '=', $hoy)
      ->where('reservas.check_in', '=', false)
      ->select(
        'reservas.id as IdentificadorReserva',
        'users.name as NomUsuari',
        'reservas.data_Entrada as data_EntradaReservas',
        'reservas.data_Sortida as data_SortidaReservas',
        'tipus_habitacions.nom as NomTipusHabitacions',
        'habitacions.ocupants_habitacio as OcupantsHabitacions',
        'reservas.persones_reserva as PersonesReserva',
        'habitacions.nom as NomHabitacions',
        'reservas.estat as EstatReservas',
        'reservas.preu as PreuReservas',
        'habitacions.observation as ObservacionHabitacions'
      )
      ->get();

    return $hotels;
  }
  public static function getReservaCheckinFiltrat($dataInici, $dataFinal ,$nomClient, $numReserva)
  {
    $hotels = DB::table('reservas')
      ->join('habitacions', 'habitacions.id', '=', 'reservas.habitacion_id')
      ->join('tipus_habitacions', 'tipus_habitacions.id', '=', 'tipus_habitacions_id')
      ->join('users', 'users.id', '=', 'usuari_id')
      ->whereBetween('reservas.data_Entrada', [$dataInici, $dataFinal])
      ->where('reservas.check_in', '=', false)
      ->where('users.name', 'like', '%' . $nomClient . '%')
      ->where('reservas.id', '=', $numReserva)
      ->select(
        'reservas.id as IdentificadorReserva',
        'users.name as NomUsuari',
        'reservas.data_Entrada as data_EntradaReservas',
        'reservas.data_Sortida as data_SortidaReservas',
        'tipus_habitacions.nom as NomTipusHabitacions',
        'habitacions.ocupants_habitacio as OcupantsHabitacions',
        'reservas.persones_reserva as PersonesReserva',
        'habitacions.nom as NomHabitacions',
        'reservas.estat as EstatReservas',
        'reservas.preu as PreuReservas',
        'habitacions.observation as ObservacionHabitacions'
      )
      ->get();
    return $hotels;
  }

  public static function checkReserva($habitacionId, $dataEntrada, $dataSortida)
  {
      
    return Reserva::where('habitacion_id', $habitacionId)
        ->where('data_Entrada', '<', $dataSortida)
        ->where('data_Sortida', '>', $dataEntrada)
        ->exists();
  }
  public static function donaDetallReserva($reservaId)
  {
    $reserva=Reserva::where('reservas.id','=',$reservaId)
          ->join('users','users.id','=','reservas.usuari_id')
          ->select(
                    'users.name as NomUsuari',
                    'users.email as emailUsuari',
                    'reservas.data_Entrada as data_Entrada',
                    'reservas.data_Sortida as data_Sortida',
                    'reservas.preu as preu',
          )
          ->first();
    return $reserva;
  }
  public function habitacion(): BelongsTo
  {
    return $this->belongsTo(Habitacion::class);
  }
}
