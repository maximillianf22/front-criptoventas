<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DistributorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $document_vp = [];
    $request = Http::get(config('app.url_apiRequest') . 'api/parameters/getParametersValues?parameter_id=1');
    if ($request['code'] == 200) {
      $document_vp = $request['data'];
    }

    return view('system.templates.webforms.provider', compact('document_vp'));
  }
  public function create()
  {
    # code...
  }

  public function store(request $request)
  {

    $this->validate($request, [
      /*    'document' => 'required|string|min:6|max:500',
          'document_type_vp' => 'required|numeric', */
      'name' => 'required|string',
      'last_name' => 'required|max:500',
      'email' => 'nullable|email',
      'cellphone' => 'required|digits:10',
      'password' => 'required|confirmed|max:500',
    ]);

    $response = Http::post(config('app.url_apiRequest') . 'api/distributor/postDistributor', [
      /*        'document' => $request->document,
          'document_type_vp' => $request->document_type_vp, */
      'name' =>  $request->name,
      'last_name' => $request->last_name,
      'email' => $request->email,
      'cellphone' => $request->cellphone,
      'password' => $request->password,
      'user_state' => 0
    ]);

// dd($response->body());
    if ($response != null) {

      if ($response['code'] == 200) {
        session()->flash('success', 'El Distribuidor ha sido registrado con exito');
        $request->session()->put('user_cellphone_login', $request->cellphone);
        return  redirect()->route('register.confirm');
      } else {

        session()->flash('danger', $response['message']);
        return redirect()->route('distribuidor.index');
      }
    } else {
      session()->flash('danger', $response['message']);
      return  redirect()->route('distribuidor.index');
    }
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
