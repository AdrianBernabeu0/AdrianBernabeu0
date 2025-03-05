<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EstatHotelController extends Controller
{
    public function index($id)
    {
        // Busca el hotel por su ID
        $hotel = Hotel::find($id);

        // Si el hotel no existe, redirige con un mensaje de error
        if (!$hotel) {
            return redirect()->route('home')->with('error', 'Hotel no encontrado');
        }

        // Obtener todas las habitaciones directamente relacionadas con el hotel
        $habitaciones = $hotel->habitacions;

        // Contar habitaciones según estado
        $totalHabitaciones = $habitaciones->count();
        $habitacionesLibres = $habitaciones->where('estat', 'lliure')->count();
        $habitacionesOcupadas = $habitaciones->where('estat', 'ocupat')->count();

        $porcentajeOcupacion = $totalHabitaciones > 0 ? ($habitacionesOcupadas / $totalHabitaciones) * 100 : 0;
        $porcentajeOcupacion = round($porcentajeOcupacion, 2);

        $fechaActual = date('d/m/Y');

        $porcentajeLibres = $totalHabitaciones > 0 ? ($habitacionesLibres / $totalHabitaciones) * 100 : 0;
        $porcentajeLibres = round($porcentajeLibres, 2);

        // Pasar datos a la vista
        return view('hotels.hotelState', compact('hotel', 'totalHabitaciones', 'habitacionesLibres', 'habitacionesOcupadas', 'habitaciones', 'porcentajeOcupacion','porcentajeLibres', 'fechaActual'));
    }
}
