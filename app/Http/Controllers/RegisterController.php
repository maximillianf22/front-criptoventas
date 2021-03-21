<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{

  public function index()
  {
    $document_vp = [];
    $request = Http::get(config('app.url_apiRequest') . 'api/parameters/getParametersValues?parameter_id=1');
    if ($request['code'] == 200) {
      $document_vp = $request['data'];
    }

    return view('system.templates.auth.register', compact('document_vp'));
  }
  public function store(request $request)
  {

    $this->validate($request, [
      // 'document' => 'required|string|min:6|max:500',
      // 'document_type_vp' => 'required|numeric',
      'name' => 'required|string',
      'last_name' => 'required|max:500',
      'email' => 'nullable|email',
      'cellphone' => 'required|digits:10',
      'password' => 'required|confirmed|max:500',
    ]);

    $response = Http::post(config('app.url_apiRequest') . 'api/client/signup', [
      // 'document' => $request->document,
      // 'document_type_vp' => $request->document_type_vp,
      'name' =>  $request->name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'cellphone' => $request->cellphone,
      'password' => $request->password,
      'password_confirmation' => $request->password,
      'distributor_code' => $request->distributor_code ?? null,
      'user_state' => 0
    ]);
    // dd($response['code']);
    if ($response != null) {

      if ($response['code'] == 200) {
        session()->flash('success', 'El usuario ha sido registrado con exito');
        $request->session()->put('user_cellphone_login', $request->cellphone);
        return  redirect()->route('register.confirm');
      } else {
        session()->flash('danger', $response['message']);
        return redirect()->route('registro.index');
      }
    } else {
      session()->flash('danger', $response['message']);
      return  redirect()->route('registro.index');
    }
  }

  public function showConfirmForm()
  {
    if (!is_null(session('user_cellphone_login'))) {
      $response = Http::post(config('app.url_apiRequest') .'api/client/sendCode', [
        'cellphone' => session('user_cellphone_login')
      ]);
    
    }
    return view('system.templates.auth.confirm');
  }

  public function confirmCode(Request $request)
  {
    $request->merge([
      'cellphone' => session('user_cellphone_login')
    ]);
    $request->validate([
      'cellphone' => 'required',
      'code' => 'required'
    ]);

    $response = Http::post(config('app.url_apiRequest') . 'api/client/confirmCode', [
      'cellphone' => $request->cellphone,
      'code' => $request->code
    ]);

    if (!is_null($response)) {
      if ($response->status() == 200) {

        if(session('confirm_mode') == 'restore'){
          return redirect()->route('password.restore');
        }else{
          session()->flash('success', 'El usuario ha sido confirmado con exito');
          $request->session()->forget('user_cellphone_login');
          return  redirect()->route('login');
        }

      } else {
        session()->flash('danger', $response['message']);
        return redirect()->route('register.confirm');
      }
    } else {
      $request->session()->forget('user_cellphone_login');
      session()->flash('danger', $response['message']);
      return  redirect()->route('registro.index');
    }
  }
}
