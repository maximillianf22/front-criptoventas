<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request1 = Http::get(config('app.url_apiRequest') . 'api/parameters/getParametersValues?parameter_id=4');
        $request2 = Http::get(config('app.url_apiRequest') . 'api/parameters/getParametersValues?parameter_id=5');
        $tipoComercio = $request1['data'] ?? [];
        $tipoDomicilio = $request2['data'] ?? [];
        return view('system.templates.webforms.market', compact('tipoComercio', 'tipoDomicilio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $emailwithoutblankspaces = preg_replace('/\s+/', '', $data['email']);
        $data['email'] = $emailwithoutblankspaces;
        $req = Http::withHeaders([
            "Accept"=>'application/json',
            "Content-Type"=>'application/json'
        ])->post(config('app.url_apiRequest').'api/commerce/postCommerce',$data);
      
        if ($req->status() == 422) {
            $errores = $req['errors'];
            return back()->withInput()
            ->with('errores', $errores);
        }

        if ($req->status() == 200) {
            return redirect()->route('login')->with('success', 'Su comercio se encuentra en proceso de solicitud, será notificado en caso de ser aceptado.');
        }else{
            return back()->with('errores','problemas con el servidor');
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


    public function request_commerceDetails($idCommerce)
    {
        $response = Http::get(config('app.url_apiRequest') . 'api/commerce/getCommerceDetails?id=' . $idCommerce);
        return $response;
    }
}
