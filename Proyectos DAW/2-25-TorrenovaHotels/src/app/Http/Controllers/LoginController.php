<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function showLoginForm()
  {
    if (Auth::user()) {
      if (Auth::user()->rol === "administrador") {
        return redirect('/home');
      } elseif (Auth::user()->rol === "recepcionista") {
        return redirect('/rooms/roomManagment');
      } else {
        return view('hotels.login');
      }
    }else{
      return view('hotels.login');
    }
  }

  public function login(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
      'password' => 'required|string',
    ]);

    $credentials = $request->only('name', 'password');

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      if (Auth::user()->rol === "recepcionista") {
        return redirect()->route("hotels.roomManagment");
      } else {
        return redirect("/home");
      }
    }
    return redirect()->route('login')->with('error', 'Usuari o contrasenya incorrectes');
  }


  public function logout()
  {
    session()->flush();
    Auth::logout();

    return redirect('/');
  }
}
