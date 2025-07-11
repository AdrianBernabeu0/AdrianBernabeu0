<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Hotel;
use App\Models\Ciutat;
use Database\Seeders\TipusHabitacionAndHabitacionSeeder;
use Illuminate\Http\Request;
use Database\Seeders\UserSeeder;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
  // La funcio create et portarà a la pantalla de creacio d'hotels
  public function create()
  {
    try {
      Log::info('HotelController(create)');
      return view('hotels.create');
    } catch (\Throwable $th) {
      Log::error('Error en HotelController(create)' . $th);
      throw $th;
    }
  }

  public function store(Request $request)
  {
    try {
      Log::info('HotelController(store)');
      $data = $request->validate([
        'nom' => 'required|max:255',
        'direccio' => 'required|max:255',
        'ciutat' => 'required|max:255',
        'pais' => 'required|max:255',
        'telefon' => 'required|digits:9|numeric',
        'email' => 'required|max:255',
        'identificadorHotel' => 'required|max:255',
      ]);
      $paisNom = $data['pais'];

      $ciutatNom = $data['ciutat'];

      $hotelNom = $data['nom'];
      $hotelDireccio = $data['direccio']; 
      $hotelTelefon = $data['telefon'];
      $hotelEmail = $data['email'];
      $hotelIdentificador = $data['identificadorHotel'];

      return view(
        'hotels.seederHotel',
        [
          'paisNom' => $paisNom,
          'ciutatNom' => $ciutatNom,
          'hotelNom' => $hotelNom,
          'hotelDireccio' => $hotelDireccio,
          'hotelTelefon' => $hotelTelefon,
          'hotelEmail' => $hotelEmail,
          'hotelIdentificador' => $hotelIdentificador
        ]
        
      );
    } catch (\Throwable $th) {
      Log::error('Error en HotelController(store)' . $th);
      throw $th;
    }
  }
  public function seederHotelStore(Request $request)
  {

    try {
      $userRecepcionista = $request->usuari;

      $data = $request->validate([
        'tipusHabitacions' => 'required|numeric',
        'habitacions' => 'required|numeric'
      ]);


      Log::info('HotelController(seederHotelStore)');
      $paisNom = $request->paisNom;
      $ciutatNom = $request->ciutatNom;
      $hotelNom = $request->hotelNom;
      $hotelDireccio = $request->hotelDireccio;
      $hotelTelefon = $request->hotelTelefon;
      $hotelEmail = $request->hotelEmail;
      $hotelIdentificador = $request->hotelIdentificador;

      $hotel = new Hotel;
      $ciutat = new Ciutat;
      $pais = new Pais;

      $pais->nom = $paisNom;
      $pais->save();

      $ciutat->nom = $ciutatNom;
      $ciutat->pais_ID = $pais->id;
      $ciutat->save();

      $hotel->nom = $hotelNom;
      $hotel->direccio = $hotelDireccio;
      $hotel->ciutat_id = $ciutat->id;
      $hotel->telefon = $hotelTelefon;
      $hotel->email = $hotelEmail;
      $hotel->identificadorHotel = $hotelIdentificador;
      $hotel->save();

      $seederHabitacions = new TipusHabitacionAndHabitacionSeeder();
      $seederHabitacions->run($data['tipusHabitacions'], $data['habitacions'], $hotel->id);

      if ($userRecepcionista === 'si') {

        $seederUser = new UserSeeder();
        $seederUser->run($userRecepcionista, $hotel->id);

      }
      Log::info('Creacio hotel: ' . $hotel->nom);
      return redirect()->route('home')->with('success', 'S\'ha creat correctament l\'hotel');
    } catch (\Throwable $th) {
      Log::error('Error en HotelController(seederHotelStore)' . $th);
      throw $th;
    }
  }
}