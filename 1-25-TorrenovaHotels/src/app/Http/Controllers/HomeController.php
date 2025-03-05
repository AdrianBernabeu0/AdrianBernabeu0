<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function home()
  {
    try {
      Log::info('HomeController(home)');
      $hotels = Hotel::HotelsCiutatPais();
      $usuarisLliures = Hotel::UsuarisSenseHotel();
      return view('home', ['hotels' => $hotels, 'usuarisLliures' => $usuarisLliures]);
    } catch (\Throwable $th) {
      Log::error('Error en HomeController(home)' . $th);
      throw $th;
    }
  }
  public function assignarUsuariHotel(Request $request)
  {
      try {
        // Validació
        $validatedData = $request->validate([
          'nomUsuari' => 'required|max:255|unique:users,name',
          'contrasenyaUsuari' => 'required|max:255'
      ]);

      $idHotel = $request->input('idHotel');
      $nomUsuari = $validatedData['nomUsuari'];
      $contrasenyaUsuari = bcrypt($validatedData['contrasenyaUsuari']); // Hashear la contrasenya

      $usuari = new User();
      $usuari->name = $nomUsuari;
      $usuari->password = $contrasenyaUsuari;
      $usuari->hotel_id = $idHotel;
      $usuari->email = null;
      $usuari->rol = 'recepcionista';

      $usuari->save();
  
          return response()->json(['success' => 'Hotel assignat correctament al usuari.']);
      } catch (\Throwable $th) {
          return response()->json(['error' => $th->getMessage()], 500);
      }
  }
}
