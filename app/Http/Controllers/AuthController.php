<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Session, Redirect;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->middleware('guestUser')->except('logout');
  }

  public function request_Login(Request $request)
  {
    $this->validate($request, [
      'cellphone' => 'required',
      'password' => 'required',
    ], [
      'cellphone.required' => 'Debes ingresar tu numero de telefono',
      'password.required' => 'Debe ingresar una contraseña',
    ]);

    $client_id = '2';
    $client_secret = 'USq4nwL9h1GEqlVTOWVnt7klLxTMvi1yYHnsJpEP';
    $grant_type = 'password';

    $response = Http::post(config('app.url_apiRequest') . 'api/client/loggin', [
      'cellphone' => $request->cellphone,
      'password' => $request->password,
      'client_id' => $client_id,
      'client_secret' => $client_secret,
      'grant_type' => $grant_type
    ]);

    if ($response != null) {
      if ($response->status() == 200) {
        $result = $response['data'];
        if ($result['confirmed'] == 1) {
          session(['active_user' => $result]);
          return Redirect::intended();
        } else {
          $request->session()->put('user_cellphone_login', $result['get_user']['cellphone']);
          return redirect()->route('register.confirm');
        }
      } elseif ($response['code'] == 423) {
        Session::flash('danger', $response['message']);
        return Redirect::route('login');
      } else {
        if ($response['code'] == 400) {
          Session::flash('danger', $response['message']);
          return Redirect::route('login');
        }
        Session::flash('danger', 'El numero de celular o la contraseña se encuentran incorrecto');
        return Redirect::route('login');
      }
    } else {
      Session::flash('danger', 'Hemos tenido problemas con la conexion');
      return Redirect::route('login');
    }
  }

  public function index()
  {

    return view('system.templates.auth.login');
  }

  public function logout()
  {
    Session::flush();
    Cart::destroy();
    return Redirect::route('home');
  }

  public function showRecoveryForm()
  {
    request()->session()->forget('user_cellphone_login');
    request()->session()->forget('confirm_mode');
    return view('system.templates.auth.recovery');
  }

  public function sendConfirmationCode(Request $request)
  {

    $response = Http::post(config('app.url_apiRequest') . 'api/client/sendCode', [
      'cellphone' => $request->cellphone
    ]);

    if ($response->status() == 200) {
      if (!is_null($response->json()['data'])) {
        $request->session()->put('user_cellphone_login', $request->cellphone);
        $request->session()->put('confirm_mode', 'restore');
        return view('system.templates.auth.confirm');
      } else {
        return back()->with('failed', 'El celular no se encuentra registrado');
      }
    }
  }

  public function showRestoreForm()
  {
    return view('system.templates.auth.restorePassword');
  }

  public function changePass(Request $request)
  {
    $request->validate([
      'password' => 'required|confirmed'
    ]);

    $response = Http::post(config('app.url_apiRequest') . 'api/client/updatePassword', [
      'cellphone' => session('user_cellphone_login'),
      'password' => $request->password
    ]);

    if ($response->status() == 200) {
      $request->session()->forget('user_cellphone_login');
      $request->session()->forget('confirm_mode');
      return redirect()->route('login')->with('success', 'Contraseña cambiada satisfactoriamente');
    }
  }
}
