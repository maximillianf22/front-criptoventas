<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function GuzzleHttp\json_decode;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::count() > 0) {
            $response = Http::get(config('app.url_apiRequest') . 'api/parameters/getParametersValues?parameter_id=2');
            $response2 = Http::get(config('app.url_apiRequest') . 'api/propina/getListTips?id=' . session('commerce.id'));
            $commerce_type_vp = session('commerce.commerce_type_vp');

            $documents_vp = $response['data'] ?? [];
            $propina = $response2['data'] ?? [];
            $address=['addresses'=>[
                ['lat'=>floatval( session('dir.lat')),'lng'=>floatval(session('dir.lng'))] ,//origen
                ['lat'=>session('commerce.get_user.get_commerce_address.lat'),'lng'=>session('commerce.get_user.get_commerce_address.lng')] //destino
            ]];
             $deliveryValue=session('commerce.delivery_value');
             if(session('commerce.delivery_config')==13){
                  $deliveryValue=Http::post(config('app.domiciliosApp').'api/getConfigs',$address)['data']['valorDomicilio']??0;
                }

             $total=intval(  str_replace(["$",",",".00"],"",Cart::subtotal()))+$deliveryValue; // cart subtotal + domicilio
    
            return view('system.templates.payment.checkout', [
                'cart' => Cart::content(),
                'total' =>  Cart::subtotal(),
                'deliveryValue'=>'$'.number_format($deliveryValue),
                'total2' => $total,
                'payment_type_vp' => $documents_vp,
                'commerce_type_vp' => $commerce_type_vp,
                'propina' => $propina
            ]);
        } else {
            return back();
        }
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
    public function checkout(Request $request)
    {
        if (Cart::count() > 0) {
            $commerce = session('commerce.id');
            $detalle = [];
            $product_config = [];
            $tip = $request->tips ?? 0;
            $allProduct="";
            foreach (Cart::content() as $item) {
                if (session('commerce.commerce_type_vp') == 9) {
                    $product_config = $item->options['aditionals'];
                }
                $allProduct.=$item->name." x$item->qty |";
                $prod =  [
                    "product_id" => $item->id,
                    "quantity" => $item->qty,
                    "observation" =>$item->options['des'],
                    "product_config" => $product_config
                ];
                $detalle[] = $prod;
            }
            $address=['addresses'=>[
                ['lat'=>floatval( session('dir.lat')),'lng'=>floatval(session('dir.lng'))] ,//origen
                ['lat'=>session('commerce.get_user.get_commerce_address.lat'),'lng'=>session('commerce.get_user.get_commerce_address.lng')] //destino
            ]];
             $deliveryValue=session('commerce.delivery_value');
             if(session('commerce.delivery_config')==13){
                  $deliveryValue=Http::post(config('app.domiciliosApp').'api/getConfigs',$address)['data']['valorDomicilio']??0;
                }

            $order = [
                "commerce_id" => $commerce,
                "customer_id" => Session('active_user')["id"],
                "payment_type_vp" => $request->payment_type_vp,
                "payment_state" => ($request->payment_type_vp==5)?19:22,
                "coupon_value" => 0,
                "tip_value" => $tip??0,
                "delivery_value" => $deliveryValue,
                "user_address_id" => $request->user_address_id,
                "shipping_date" => $request->shipping_date,
                "order_details" => $detalle

            ];
            if (!empty($request->name)) {
              $order= array_merge($order,['name'=>$request->name]);
            }
            if (!empty($request->observation)) {
              $order= array_merge($order,['observation'=>$request->observation]);
            }
            if (!empty($request->distributor_id)) {
              $order= array_merge($order,['distributor_id'=>$request->distributor_id]);
            }
            if(Session('active_user')['get_user']['rol_id'] == 4){
                $order= array_merge($order, ['userDistributor_id' => Session('active_user')['get_user']['id']]);
            }

            $order = array_merge($order,['dateSelected'=>$request->objectDateSelected]);
            
            $response = Http::post(config('app.url_apiRequest') . 'api/order/postOrder',  $order);

            if ($response['code'] == 200) {

                $signature="";
                $total="";
                $reference="";
                if ($request->payment_type_vp==5) {
                    $total=$response['data']['total'];
                    $apiKey=env('PAYU_APIKEY');
                    $merchanId=env('PAYU_MERCHANTID');
                    $reference=$response['data']['reference'];
                    $presignature="$apiKey~$merchanId~$reference~$total~COP";
                    $signature=md5($presignature);
                }
               session()->forget('commerce');
                Cart::destroy();
                return response()->json(['message'=>'Pedido creado','data'=>['description'=>$allProduct,'signature'=>$signature,'id'=>$response['data']['id'],'reference'=>$reference,'total'=>$total]], 200);
            } else {
                return response()->json($response->body(), 400);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $idProduct = $request->input('Product');
        $qty = $request->qty; // cantidad del producto
        $aditionals = $request->aditionals;
        $idUser = session()->has('active_user') ? session('active_user')['id'] : 0;
        $product = Http::get(config('app.url_apiRequest') . 'api/product/getProductDetails?searchID=' . $idProduct . '&idCustomer=' . $idUser);
        $product = json_decode($product);

        $commerce = $request->commerce;

        if ($product->code == 200) {
            $product = $product->data;
            if ((session()->has('commerce') && session('commerce.id') == $commerce) || !session()->has('commerce')) {
                if (!session()->has('commerce')) {
                    $commerce = Http::get(config('app.url_apiRequest') . 'api/commerce/getCommerceDetails?id=' . $commerce);
                    if ($commerce["code"] == 200) {
                        session(['commerce' => $commerce["data"]]);
                        $minimoCompra = Http::get(config('app.url_apiRequest') . 'api/config/getMinShopping?commerce_id=' . $commerce['data']['id']);
                        if ($minimoCompra['code'] == 200) {
                            if (count($minimoCompra['data']) > 0) {
                                $collection = collect($minimoCompra['data']);
                                $role_id = session('active_user.get_user.rol_id');
                                $userMinimo = $collection->where('profile_vp', $role_id);
                                foreach ($userMinimo as $key) {
                                   session(['minimoCompra' => $key]);
                                }

                            }
                        }
                    } else {
                        return response()->json(["commercio invalido"], 400);
                    }
                }
                $precio = $product->value->discount??$product->value->value;

                $temp = session('commerce.commerce_type_vp');
                if ($temp == 9) {
                    $ingredients = Http::get(config('app.url_apiRequest') . 'api/product/getProductIngredients?restaurant_product_id=' . $product->getRestaurantProduct->id);
                    if ($ingredients['code'] == 200) {
                        $ingredients = collect($ingredients['data']);
                        $aditionals = collect($aditionals);



                        foreach ($ingredients as $tipoingre) {
                            foreach ($aditionals as $catIn) {
                                foreach ($tipoingre['categorias'] as $categorias) {
                                    if (intval($catIn['ingredient_category_id']) == $categorias['id']) {
                                        foreach ($catIn['get_ingredients'] as $ingreCatIn) {
                                            foreach ($categorias["get_ingredients"] as $ingre) {
                                                if (intval($ingreCatIn['ingredient_id']) == $ingre['id']) {
                                                    $precio += ($ingre['value'] ?? 0) * intval($ingreCatIn['ingredient_quantity']);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $cartItem = Cart::add(
                    $product->id, // id
                    $product->name, //nombre del producto
                    $qty, // cantidad del producto
                    $precio,  // valor del producto
                    ['des' => $product->description,'unit'=>!empty($product->getUnit)?$product->getUnit->name:'und', 'aditionals' => $aditionals, 'img' => config('app.url_apiRequest') . 'storage/' . $request->img] // opciones extras
                );

                return response()->json(["Exito al agregar al Carrito", "counter" => Cart::count()], 200);
            } else {
                return response()->json("Solo se permite un carrito por comercio", 400);
            }
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
        return response()->json(["count"=>Cart::count()], 200);
    }

    public function destroyer()
    {
        session()->forget('commerce');
        Cart::destroy();
        return back();
    }
    public function destroyer2()
    {
        session()->forget('commerce');
        Cart::destroy();
        return redirect()->route('home');
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
        $op = $request->operation;
        $rowId = $request->rowId;

        $item = Cart::get($rowId);


        switch ($op) {
            case '+':
                Cart::update($item->rowId, $item->qty + 1);
                $view = View::make('system.layouts.global.components.modalRight')->with('Cart', Cart::content());
                $sections = $view->renderSections();
                return response()->json(["view" => $sections['detalle'], "total" => Cart::subtotal()], 200);
                break;

            case '-':
                Cart::update($item->rowId, $item->qty - 1);
                if (Cart::count() == 0) {
                    session()->forget('commerce');
                }
                $view = View::make('system.layouts.global.components.modalRight')->with('Cart', Cart::content());
                $sections = $view->renderSections();
                return response()->json(["view" => $sections['detalle'], "total" => Cart::subtotal()], 200);
                break;

            default:
                return response()->json("error del sistema operacion no permitida", 400);
                break;
        }
    }
    public function replay($id)
    {

        if (!Cart::count()>0) {
            $order = Http::get(config('app.url_apiRequest').'api/order/getOrderDetail?id='.$id)['data']??[];
            if(count($order)>0){
                $products=$order['get_order_details'];
                $nonActive=[];
                $commerce = Http::get(config('app.url_apiRequest') . 'api/commerce/getCommerceDetails?id=' . $order['commerce_id'])['data']??[];

                if ($commerce['state']==1) {
                    session(['commerce'=>$commerce]);
                    foreach ($products as $item) {

                        if ($item['get_product']['state']==1) {
                            $options= ['des' => $item['observation'], 'aditionals' =>json_decode($item['product_config'],true), 'img' => config('app.url_apiRequest') . 'storage/' . $item['get_product']['img_product']];
                            if(!empty($item['get_product']['get_market_product'])){
                              $options=array_merge($options,['unit'=>$item['get_product']['get_market_product']['get_unit']['name']]);
                            }
                            

                            $cartItem = Cart::add(
                                $item['product_id'], // id
                                $item['name'], //nombre del producto
                                $item['quantity'], // cantidad del producto
                                $item['value'], // valor del producto
                                $options  // opciones extras
                            );
                        }else{
                            $nonActive[]=$item;
                        }
                    }
                    if(Cart::count()>0)
                        return response()->json(['message'=>'Exito al repetir carrito','data'=>$nonActive],200);
                    return response()->json(['message'=>'todos lo productos inactivos','data'=>$nonActive],400);
                }else{
                    return response()->json(['message'=>'commercio inactivo'],400);
                }
            } else{
                return response()->json(['message'=>'id erroneo'],400);
            }
        }else{
            return response()->json(['message'=>'Carrito lleno debe vaciarlo'],400);
        }
    }

    public function getShippingHour(Request $request)
    {
        $request->validate(['weekDate' => 'min:1|max:7']);
        $weekDate = $request->weekDate;
        $commerce = session('commerce.id');
        $response = Http::get(config('app.url_apiRequest') . 'api/commerce/getShippingHour?commerce_id=' . $commerce . '&weekDay=' . $weekDate);
        $hours = $response['data'] ?? [];

        return response()->json($hours, 200);
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
    public function getCoupon(Request $request)
    {
        $request->validate(['name'=>'required|string','commerce_id'=>'required|numeric']);
        $data=$request->input();
        $req=Http::withHeaders(
            ['Accept'=>'application/json']
        )-> post(config('app.url_apiRequest') . 'api/coupons/getCoupon',$data);

        return response()->json(json_decode($req),$req['code']);

    }
    public function getDistributor(Request $request){
        $request->validate(['distributor_code'=>'required|string']);
        $data=$request->input();

        $req=Http::withHeaders(
            ['Accept'=>'application/json']
        )-> post(config('app.url_apiRequest') .'api/distributor/getDistributor',$data);

        return response()->json(json_decode($req),$req['code']);                 
    }

}
