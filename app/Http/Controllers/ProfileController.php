<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use AuthUser, Http;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class ProfileController extends Controller
{
    public function index()
    {

        $id = AuthUser::data()->user_id;
        $response = Http::get(config('app.url_apiRequest') . 'api/client/getListAddress', [
            'id' => $id
        ]);
        $response2 = Http::get(config('app.url_apiRequest') . 'api/parameters/getParametersValues?parameter_id=1');
        $response2 = json_decode($response2);
        $favores = Http::post(config('app.domiciliosApp') . 'api/getFavores/' . session('active_user.get_user.cellphone'))['data'] ?? [];
        if ($response != null) {
            if ($response['code'] == 200 && $response2->code == 200) {
                $addresses = json_decode(json_encode($response['data']));
                $document_vp = $response2->data;
                $listOrders = $this->getListOrder()->getData()->data; //obtener la lista de pedidos
                //$listOrders = $listOrdersData->data;
                //dd($listOrders);
                return view('system.templates.user.profile', compact('addresses', 'document_vp', 'listOrders', 'favores'));
            } elseif ($response['code'] == 400) {
                Session::flash('danger', $response['message']);
                return Redirect::route('home');
            } else {
                Session::flash('danger', 'Hemos tenido problemas con la conexion');
                return Redirect::route('home');
            }
        } else {
            Session::flash('danger', 'Hemos tenido problemas con la conexion');
            return Redirect::route('home');
        }
    }
    public function update(Request $request)
    {
        $id = AuthUser::data()->id;
        $userData = session('active_user');

        $request->validate([
            'name' => 'string',
            'last_name' => 'string',
            // 'document'=>'digits:10',
            'email' => 'nullable|email',
            'cellphone' => 'digits:10',
        ]);
            // dd($request->password);
        if (!is_null($request->password)) {
            $request->validate([
                'password' => 'min:6|confirmed'
            ]);
        }
        $response = Http::post(config('app.url_apiRequest') . 'api/client/updateProfile', [
            'id' => $id,
            // 'document_type_vp'=>$request->document_type_vp,
            'name' => $request->name,
            'last_name' => $request->last_name,
            // 'document'=>$request->document,
            'email' => $request->email,
            'cellphone' => $request->cellphone,
            'password_confirmation' => $request->password_confirmation,
            'password' => $request->password,
            'user_state' => 1
        ]);


        //  10$response=json_decode($response);
        if ($response['code'] == 200) {
            $userData['get_user'] = $response['data']['get_user'];
            //session('active_user',$userData);
            session()->put('active_user', $userData);
            session()->save();
            session()->flash('success', 'Actualizacion exitosa');
        } else {
            session()->flash('danger', 'Problemas con su solicitud. ' . $response['message']);
        }
        return redirect('perfil');
    }

    public function addAddress(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'observation' => 'nullable',
        ], [
            'name.required' => 'Debes ingresar el nombre de la dirección',
            'address.required' => 'Debe ingresar la dirección',
        ]);

        $id = AuthUser::data()->get_user->id;

        $response = Http::post(config('app.url_apiRequest') . 'api/client/postAddAddress', [
            'user_id' => $id,
            'name' => $request->name,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'observation' => $request->observation,
        ]);

        if ($response != null) {
            if ($response['code'] == 200) {
                $data = $response['data'];

                session(['dir' => ['lat' => $data['lat'], 'lgn' => $data['lng']]]);
                return response()->json([
                    'state' => 1,
                    'data' => $data,
                    'message' => 'Dirección agregada correctamente'
                ]);
            } elseif ($response['code'] == 400) {
                return response()->json([
                    'state' => 2,
                    'data' => null,
                    'message' => $response['message']
                ]);
            } else {
                return response()->json([
                    'state' => 2,
                    'data' => null,
                    'message' => 'Hemos tenido problemas, intenta nuevamente'
                ]);
            }
        } else {
            return response()->json([
                'state' => 2,
                'data' => null,
                'message' => 'Hemos tenido problemas, intenta nuevamente'
            ]);
        }
    }

    public function editAddress(Request $request)
    {
        $idAddress = $request->idAddress;

        $response = Http::get(config('app.url_apiRequest') . 'api/client/getAddressDetails', [
            'id' => $idAddress
        ]);

        if ($response != null) {
            if ($response['code'] == 200) {
                $data = $response['data'];
                return response()->json([
                    'state' => 1,
                    'data' => $data,
                    'message' => 'Detalle de la dirección'
                ]);
            } elseif ($response['code'] == 400) {
                return response()->json([
                    'state' => 2,
                    'data' => null,
                    'message' => $response['message']
                ]);
            } else {
                return response()->json([
                    'state' => 2,
                    'data' => null,
                    'message' => 'Hemos tenido problemas, intenta nuevamente'
                ]);
            }
        } else {
            return response()->json([
                'state' => 2,
                'data' => null,
                'message' => 'Hemos tenido problemas, intenta nuevamente'
            ]);
        }
    }

    public function updateAddress(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'observation' => 'nullable',
        ], [
            'name.required' => 'Debes ingresar el nombre de la dirección',
            'address.required' => 'Debe ingresar la dirección',
        ]);

        $id = AuthUser::data()->get_user->id;

        $response = Http::post(config('app.url_apiRequest') . 'api/client/postUpdateAddress', [
            'id' => $request->id,
            'user_id' => $id,
            'name' => $request->name,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'observation' => $request->observation,
        ]);

        if ($response != null) {
            if ($response['code'] == 200) {
                $data = $response['data'];

                return response()->json([
                    'state' => 1,
                    'data' => $data,
                    'message' => 'Dirección editada correctamente'
                ]);
            } elseif ($response['code'] == 400) {
                return response()->json([
                    'state' => 2,
                    'data' => null,
                    'message' => $response['message']
                ]);
            } else {
                return response()->json([
                    'state' => 2,
                    'data' => null,
                    'message' => 'Hemos tenido problemas, intenta nuevamente'
                ]);
            }
        } else {
            return response()->json([
                'state' => 2,
                'data' => null,
                'message' => 'Hemos tenido problemas, intenta nuevamente'
            ]);
        }
    }

    public function deleteAddress(Request $request)
    {
        $idAddress = $request->idAddress;

        $response = Http::post(config('app.url_apiRequest') . 'api/client/postDeleteAddress', [
            'id' => $idAddress
        ]);

        if ($response != null) {
            if ($response['code'] == 200) {
                $data = $response['data'];
                return response()->json([
                    'state' => 1,
                    'data' => null,
                    'message' => 'Dirección eliminada correctamente'
                ]);
            } elseif ($response['code'] == 400) {
                return response()->json([
                    'state' => 2,
                    'data' => null,
                    'message' => $response['message']
                ]);
            } else {
                return response()->json([
                    'state' => 2,
                    'data' => null,
                    'message' => 'Hemos tenido problemas, intenta nuevamente'
                ]);
            }
        } else {
            return response()->json([
                'state' => 2,
                'data' => null,
                'message' => 'Hemos tenido problemas, intenta nuevamente'
            ]);
        }
    }

    public function selectDirection(request $request)
    {

        session(['dir' => ["id" => $request->id, "address" => $request->dir]]);
        return response()->json(['dir' => $request->id], 200);
    }
    public function getListOrder()
    {
        $id = AuthUser::data()->id;

        $response = Http::get(config('app.url_apiRequest') . 'api/order/getListOrder', [
            'id' => $id
        ]);
        //  dd($response['data']);

        if ($response['code'] == 200) {

            return response()->json(['state' => 1, 'data' => $response['data'], 'message' => 'exito']);
        } else {

            return response()->json(['state' => 2, 'data' => [], 'message' => $response['message']]);
        }
    }
    public function addDir(request $request)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required',
            'lat' => 'required'
        ]);
        $data = $request->only('lng', 'lat');
        session(['dir' => $data]);
        return response()->json('Exito', 200);
    }
}
