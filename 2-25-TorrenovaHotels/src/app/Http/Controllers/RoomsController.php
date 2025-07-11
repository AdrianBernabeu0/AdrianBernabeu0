<?php

namespace App\Http\Controllers;

use App\Models\Hotel;

use App\Models\Reserva;
use App\Models\Habitacion;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoomsController extends Controller
{
  public function show()
  {
    $habitacionsCheckIn = Reserva::getReservaCheckIn();
    return view("rooms.checkInList", ['habitacionsCheckIn' => $habitacionsCheckIn]);
  }

  public function search(Request $request)
  {
    try {
      $dataInici = $request->input('dataInici');
      $dataFinal = $request->input('dataFinal');
      $nomClient = $request->input('nomClient');
      $numReserva = $request->input('numReserva');

      $habitacionsCheckIn = Reserva::getReservaCheckInFiltrat($dataInici, $dataFinal,$nomClient, $numReserva);
      
      return response()->json($habitacionsCheckIn);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function showDetallHabitacion($idhabitacion)
  {
    try {
      $habitacion = Habitacion::donaDetalls($idhabitacion);
      return response()->json($habitacion);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }
  public function showDetallReserva($idReserva)
  {
    try {
      // Buscar la habitación con su reserva asociada
      $reserva = Reserva::donaDetallReserva($idReserva);
      return response()->json($reserva);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function roomManagment(Request $request)
  {
    try {
      $habitacions = Hotel::getRoomsByHotel($request->user()->hotel_id);

      $diaInici = now()->subDays(5);

      $diasCalendari = [];
      for ($i = 0; $i < 31; $i++) {
        $date = $diaInici->copy()->addDays($i);
        $diasCalendari[] = [
          'day' => $date->day,
          'month' => $date->format('M'),
          'date' => $date->format('Y-m-d'),
        ];
      }

      return view("hotels.roomManagment", ['habitacions' => $habitacions, 'diasCalendari' => $diasCalendari]);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function index(Request $request)
  {
    $startDate = $request->input('start_date', date('Y-m-d', strtotime('-5 days')));
    $startDate = new \DateTime($startDate);

    $endDate = (clone $startDate)->modify('+30 days');

    $diasCalendari = [];
    $currentDate = clone $startDate;
    while ($currentDate <= $endDate) {
      $diasCalendari[] = [
        'day' => $currentDate->format('d'),
        'month' => $currentDate->format('M'),
        'date' => $currentDate->format('Y-m-d'),
      ];
      $currentDate->modify('+1 day');
    }

    $habitacions = Hotel::getRoomsByHotel($request->user()->hotel_id);
    return view('hotels.roomManagment', compact('diasCalendari', 'habitacions'));
  }

  public function checkIn(Request $request)
  {
    Log::debug('Entering checkIn method');
    try {
      $query = Reserva::query()->with(['user', 'hotel', 'room']);

      if ($request->has('start_date') && $request->has('end_date') && !empty($request->start_date) && !empty($request->end_date)) {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $query->where(function ($q) use ($startDate, $endDate) {
          $q->whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate]);
        });
      }

      if ($request->has('reserve_name') && !empty($request->reserve_name)) {
        $reserveName = strtolower($request->reserve_name);
        $query->whereHas('user', function ($q) use ($reserveName) {
          $q->whereRaw('LOWER(name) LIKE ?', ['%' . $reserveName . '%']);
        });
      }

      if ($request->has('reserve_id') && !empty($request->reserve_id)) {
        $reserveId = $request->reserve_id;
        $query->where('id', $reserveId);
      }

      $reservas = $query->get();

      return view('reception.check-in', compact('reservas'));
    } catch (Exception $e) {
      Log::error('Error fetching check-ins', ['error' => $e->getMessage()]);
      return redirect()->route('admin.index')->with('error', 'Error al obtener los check-ins');
    }
  }

  public function checkOut(Request $request)
  {
    try {
      $idReserva = $request->input(0);
      Reserva::where('id', $idReserva)->update(['check_out' => true]);
      $idHabitacion = Reserva::findOrFail($idReserva);
      $habitacion = Habitacion::where('id', $idHabitacion->habitacion_id)->update(['estat' => 'lliure']);
      return response()->json($habitacion);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function showReserves(Request $request)
  {
    try {
      $idHabitacion = $request->input();
      $reserva = Reserva::join('users', 'users.id', '=', 'reservas.usuari_id')
        ->select('reservas.*', 'users.name as usuari')
        ->whereIn('reservas.habitacion_id', $idHabitacion)
        ->get();

      return response()->json($reserva);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }

  public function roomBlock(Request $request)
  {
    try {
      $idHabitacion = $request->input(0);
      $habitacion = Habitacion::find($idHabitacion);
      if ($habitacion->estat === 'bloquejat') {
        $habitacion->update(['estat' => 'lliure']);
      } else {
        $habitacion->update(['estat' => 'bloquejat']);
      }
      return response()->json([
        'id' => $habitacion->id,
        'estat' => $habitacion->estat
      ]);
    } catch (\Throwable $th) {
      return response()->json(['error' => $th->getMessage()], 500);
    }
  }
}
