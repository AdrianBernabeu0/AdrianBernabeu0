<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Habitacion extends Model
{
  use HasFactory;
  protected $fillable = [
    'llit',
    'llit_extra',
    'ocupants_habitacio',
    'estat',
    'observation',
    'nom',
];
public function TipusHabitacion(): BelongsTo
    {
        return $this->belongsTo(TipusHabitacion::class);
    }
    public function Hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reserva(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }
public static function donaDetalls($id)  {
    $detall = DB::table ('reservas')
    ->join('users','users.id','=','reservas.usuari_id')
    ->join('habitacions','habitacions.id','=','reservas.habitacion_id')
    ->join('tipus_habitacions', 'tipus_habitacions.id', '=', 'habitacions.tipus_habitacions_id')
    ->join('serveis','serveis.id','=','habitacions.id')
    ->select('reservas.id as Identificador_reserva','users.name as  Identificador_client'
    , 'serveis.nom as Nom_servei','habitacions.estat as Estat_habitacion', 'habitacions.llit as Nombre_llits', 'habitacions.id as Habitacio_id', 'habitacions.id as Habitacio_id', 'tipus_habitacions.nom as Nom_tipus_habitacio')
    ->where('habitacions.id','=',$id)
    ->whereDate('reservas.data_Entrada', '<=', now()) // La reserva ya inició
    ->whereDate('reservas.data_Sortida', '>=', now())
    ->first();
    if (!$detall) {
        $habitacion = DB::table('habitacions')
            ->leftJoin('serveis', 'serveis.id', '=', 'habitacions.id')
            ->leftJoin('tipus_habitacions', 'tipus_habitacions.id', '=', 'habitacions.tipus_habitacions_id')
            ->select(
                'habitacions.estat as Estat_habitacion',
                'habitacions.llit as Nombre_llits',
                'serveis.nom as Nom_servei',
                'habitacions.id as Habitacio_id',
                'tipus_habitacions.nom as Nom_tipus_habitacio'

            )
            ->where('habitacions.id', '=', $id)
            ->first();
    $array=[
            'habitacion' => $habitacion,
            'mensaje' => 'No hi ha reserves associades a aquesta habitació.',
        ];
        Log::info('Detalls sobre les habitacions que no tenen reserves');
        return $array;
    }
    Log::info('Detalls sobre les reserves');
    return $detall;
}

public static function api($destinacio, $dataInici, $dataFinal, $quantitatReserva)
{
    $api = DB::table('habitacions')
        ->leftJoin('reservas', function ($join) use ($dataInici, $dataFinal) {
            $join->on('reservas.habitacion_id', '=', 'habitacions.id')
                ->where(function ($query) use ($dataInici, $dataFinal) {
                    $query->whereDate('reservas.data_Entrada', '<=', $dataFinal)
                          ->whereDate('reservas.data_Sortida', '>=', $dataInici);
                });
        })
        ->join('tipus_habitacions', 'habitacions.tipus_habitacions_id', '=', 'tipus_habitacions.id')
        ->join('hotels', 'hotels.id', '=', 'habitacions.hotel_id')
        ->join('ciutats', 'ciutats.id', '=', 'hotels.ciutat_id')
        ->select(
            'tipus_habitacions.nom as NomTipusHabitacio',
            'tipus_habitacions.preu_base as PreuTipusHabitacio',
            'habitacions.ocupants_habitacio as OcupantsHabitacio',
            'habitacions.imatge as Imatge',
            'habitacions.observation as Descripcio',
            'habitacions.nom as NomHabitacio',
            'hotels.nom as NomHotel',
            'reservas.data_Entrada as DataEntrada',
            'reservas.data_Sortida as DataSortida',
            'tipus_habitacions.id as IdTipusHabitacio'
        )
        ->where('ciutats.nom', $destinacio)
        ->where(function ($query) {
            $query->whereNull('reservas.id') // Habitaciones sin reserva
                  ->orWhere(function ($subquery) {
                      $subquery->whereNotNull('reservas.id'); // Habitaciones con reserva pero filtradas
                  });
        })
        ->where('habitacions.ocupants_habitacio', '>=', (int) $quantitatReserva) // Asegurar que hay capacidad
        ->get();

    return $api;
}



}
