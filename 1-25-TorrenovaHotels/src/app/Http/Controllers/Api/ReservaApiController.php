<?php

namespace App\Http\Controllers\Api;

use App\Models\Reserva;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservaApiController extends Controller
{
    public function index(Request $request)
    {
      $dataInici = $request->input('dataInici');
      $dataFinal = $request->input('dataFinal');
      $idHabitacio = $request->input('habitacioId');
      $ocupants = $request->input('ocupants');
      $preu = $request->input('preu');

      $reserva = new Reserva;
      $reserva->habitacion_id = $idHabitacio;
      $reserva->data_Entrada = $dataInici;
      $reserva->data_Sortida = $dataFinal;
      $reserva->check_in = 0;
      $reserva->check_out = 0;
      $reserva->preu = $preu;
      $reserva->estat = 'Pagada';
      $reserva->persones_reserva = $ocupants;
      $reserva->usuari_id = null;

      $reserva->save();

      return response()->json(['message' => 'Reserva creada correctament']);
    }
}
