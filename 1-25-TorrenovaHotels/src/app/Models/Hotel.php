<?php

namespace App\Models;

use DateTime;
use App\Models\Ciutat;
use App\Models\TipusHabitacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Hotel extends Model
{
  use HasFactory;
    protected $fillable = [
        'id',
        'nom',
        'direccio',
        'ciutat_id',
        'telefon',
        'email',
        'identificadorHotel'
    ];
    //Aquesta funció et retornarà els noms dels hotels les habitacions que són lliures i ocupat i també les habitacions que no hagin fet check in avui.
    public static function habitacionsEstatReserva() {
      $dataAvui=date('Y-m-d');
      $habitacions = DB::table('hotels')
      //Ens conectem les taules
        ->join('habitacions', 'habitacions.hotel_id', '=', 'hotels.id')
          ->join('reservas','reservas.habitacion_id','=','habitacions.id')
      //Fem select de les dades
          ->select(
              'hotels.nom','hotels.id',
              DB::raw('SUM(CASE WHEN habitacions.estat = "lliure" THEN 1 ELSE 0 END) as lliure'),
              DB::raw('SUM(CASE WHEN habitacions.estat = "ocupat" THEN 1 ELSE 0 END) as ocupat'),
              DB::raw('SUM(CASE WHEN reservas.check_in = false AND DATE(reservas.data_Entrada) = '.$dataAvui.' THEN 1 ELSE 0 END) as falseCheckIn'),
          )
          ->groupBy('hotels.nom','hotels.id')
          ->get();
  
      return $habitacions;
  }

  //Aquesta funcio retornarà els hotels amb el seu pais i la ciutat
  public static function HotelsCiutatPais()
  {
      $hotels = DB::table('hotels')
      ->join('ciutats', 'ciutats.id', '=', 'hotels.ciutat_id')
      ->join('pais', 'pais.id', '=', 'ciutats.id')
      ->select('hotels.id as IdentificadorHotel', 'hotels.nom as nomHotel','hotels.direccio as direccio', 'ciutats.nom as nomCiutat','pais.nom as nomPais', 'hotels.telefon as telefon','hotels.email as email')      ->get();

      return $hotels;

  }

  public static function UsuarisSenseHotel()
{
    $usuarisSenseHotel = DB::table('users')
        ->leftJoin('hotels', 'hotels.id', '=', 'users.hotel_id')
        ->select(
            'users.id as IdentificadorUsuari',
            'users.name as NomUsuari',
            'users.email as Correu',
        )
        ->whereNull('users.hotel_id')
        ->where('users.rol', 'recepcionista')
        ->get();

    return $usuarisSenseHotel;
}
  //Aquesta funció retornará les habitacions del hotel associat
  public static function getRoomsByHotel($idHotel)
  {
      $habitacionsHotels = DB::table('habitacions')
      ->join('hotels', 'habitacions.hotel_id', '=', 'hotels.id')
          ->where('hotels.id', $idHotel)
          ->select('habitacions.nom as NomHabitacions','habitacions.id as idHabitacions')
          ->orderBy('habitacions.nom')
          ->get();
  
      return $habitacionsHotels;
  }

  public static function getRoomsByHotelInCreateReserva($idHotel)
  {
      $habitacionsHotels = DB::table('habitacions')
      ->join('hotels', 'habitacions.hotel_id', '=', 'hotels.id')
          ->where('hotels.id', $idHotel)
          ->select('habitacions.nom as NomHabitacions','habitacions.id as idHabitacions')
          ->orderBy('habitacions.nom')
          ->where('habitacions.estat', '!=', 'bloquejat')
          ->get();
  
      return $habitacionsHotels;
  }
  
public function ciutat(): BelongsTo
  {
      return $this->belongsTo(Ciutat::class);
  }


  public function habitacions()
  {
      return $this->hasMany(Habitacion::class);
  }

}
