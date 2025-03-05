<?php

namespace App\Http\Controllers\Api;

use App\Models\Habitacion;
use Illuminate\Http\Request;
use App\Models\TipusHabitacion;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;


class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $destinacio = $request->query('destinacio');
        $dataInici = $request->query('dataInici');
        $dataFinal = $request->query('dataFinal');
        $quantitatReserva = $request->query('quantitatReserva');

        Log::info("Datos recibidos:", [
            'destinacio' => $destinacio,
            'dataInici' => $dataInici,
            'dataFinal' => $dataFinal,
            'quantitatReserva' => $quantitatReserva
        ]);
        
        $habitacioOcupants = Habitacion::api($destinacio,$dataInici,$dataFinal,$quantitatReserva);
         return response()->json($habitacioOcupants);
    }



}
