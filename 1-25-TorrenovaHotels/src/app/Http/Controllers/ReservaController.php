<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reserva;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use App\Models\TipusHabitacion;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
  public function index(Request $request)
  {
    try {
      //Modifiquem les dates per posar l'hora correctament
      $fechaActual = date('Y-m-d');
      $fechaSiguiente = date('Y-m-d', strtotime('+1 day'));

      //Condicio per si s'accedeix per una habitació
      if ($request->idHabitacion) {

        $idHabitacio = $request->idHabitacion;
        $nomTipusHabitacio = $request->nomTipushabitacio;

        $tipusHabitacio = TipusHabitacion::where('nom', $nomTipusHabitacio)->first();



        $habitacio = Habitacion::find($idHabitacio);
        if ($habitacio->estat === 'bloquejat') {
          return redirect()->back()->with('error', 'L\'habitació està bloquejada');
        } else {

          return view('reserva.createReserva', [
            'nomUsuari' => Auth::user()->name,
            'habitacio' => $habitacio,
            'fechaActual' => $fechaActual,
            'fechaSiguiente' => $fechaSiguiente,
            'tipusHabitacions' => $tipusHabitacio
          ]);
        }
      } else {

        $habitacioFiltrar = Hotel::getRoomsByHotelInCreateReserva($request->user()->hotel_id);
        return view('reserva.createReserva', [
          'nomUsuari' => Auth::user()->name,
          'habitacioFiltrar' => $habitacioFiltrar,
          'fechaActual' => $fechaActual,
          'fechaSiguiente' => $fechaSiguiente,
        ]);

      }
    } catch (\Throwable $th) {
      throw $th;
    }
  }
  public function store(Request $request)
  {
    try {

      //Validació
      $data = $request->validate([
        'dadesClient' => 'required|string|',
        'habitacio' => 'required',
        'tipusHabitacioNom' => 'required',
        'tipusHabitacioPreu' => 'required',
        'dataEntrada' => 'required',
        'dataSortida' => 'required',
        'preu' => 'required',
      ]);

      $habitacio = $data['habitacio'];
      $dataEntrada = $data['dataEntrada'];
      $dataSortida = $data['dataSortida'];
      $preu = $data['preu'];

      $idHabitacio = $request->habitacio;

      $habitacio = Habitacion::find($idHabitacio);
      //Modifiquem les dates per guardar correctament en la base de dades
      $dataEntrada = str_replace('T', ' ', $data['dataEntrada']);
      $dataSortida = str_replace('T', ' ', $data['dataSortida']);

      // Verificar disponibilitat abans de crear la reserva
      if (Reserva::checkReserva($idHabitacio, $dataEntrada, $dataSortida)) {
        $fechaActual = date('Y-m-d');
        $fechaSiguiente = date('Y-m-d', strtotime('+1 day'));

        $nomTipusHabitacio = $request->tipusHabitacioNom;

        $tipusHabitacio = TipusHabitacion::where('nom', $nomTipusHabitacio)->first();

        $missatgeError = 'L\'habitació no esta disponible en les dates seleccionades';
        
        //Condició per si s'accedeix directament desde la pagina de roomManagment
        if ($request->habitacioSeleccionada) {

          $habitacioFiltrar = Hotel::getRoomsByHotel($request->user()->hotel_id);

          return view('reserva.createReserva', [
            'nomUsuari' => Auth::user()->name,
            'fechaActual' => $fechaActual,
            'habitacioFiltrar' => $habitacioFiltrar,
            'fechaSiguiente' => $fechaSiguiente,
            'missatgeError' => $missatgeError
          ]);
        }

        return view('reserva.createReserva', [
          'nomUsuari' => Auth::user()->name,
          'habitacio' => $habitacio,
          'fechaActual' => $fechaActual,
          'fechaSiguiente' => $fechaSiguiente,
          'tipusHabitacions' => $tipusHabitacio,
          'missatgeError' => $missatgeError
        ]);
      }

      $reserva = new Reserva;
      $reserva->habitacion_id = $idHabitacio;
      $reserva->data_Entrada = $dataEntrada;
      $reserva->data_Sortida = $dataSortida;
      $reserva->check_in = 0;
      $reserva->check_out = 0;
      $reserva->preu = $preu;

      $reserva->estat = 'Reserva Confirmada';
      $reserva->persones_reserva = 0;

      $reserva->usuari_id = Auth::user()->id;

      $reserva->save();

      return redirect()->route('hotels.roomManagment')->with('success', value: 'S\'ha creat correctament la reserva');
    } catch (\Throwable $th) {
      throw $th;
    }
  }
  public function getTipusHabitacio(Request $request)
  {
      $idHabitacio = $request->input('habitacio_id');
  
      $tipusHabitacio = TipusHabitacion::getTipusHabitacioByHabitacioId($idHabitacio);
  
      if (!$tipusHabitacio) {
          return response()->json(['error' => 'Habitació no trobada'], 404);
      }
  
      return response()->json($tipusHabitacio);
  }
}
