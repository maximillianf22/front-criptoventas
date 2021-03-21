<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function show($id=null,Request $request)
    {

        if (!empty($id)) {
            $order = Http::get(config('app.url_apiRequest').'api/order/getOrderDetail?id='.$id)['data']??[];
            if(count($order)>0)
            $commerce= Http::get(config('app.url_apiRequest').'api/commerce/getCommerceDetails?id='.$order['commerce_id'])['data']??[];
            $tipoPago= Http::get(config('app.url_apiRequest') . 'api/parameters/getParametersValues?parameter_id=2')['data']??[];
            $orderState= Http::get(config('app.url_apiRequest') . 'api/parameters/getParametersValues?parameter_id=6')['data']??[];
            $paymentState=Http::get(config('app.url_apiRequest') . 'api/parameters/getParametersValues?parameter_id=7')['data']??[];
            $distributor = Http::get(config('app.url_apiRequest') . 'api/distributor/comissions/byOrderid/'.$id);
            $distributor = $distributor['data'];
       
            $randy=Str::random(20);
            $signature="";
            if ($order['payment_type_vp']==5) {
                $total=$order['total'];
                $apiKey=env('PAYU_APIKEY');
                $merchanId=env('PAYU_MERCHANTID');
                $reference=$order['reference'].$randy;
                $presignature="$apiKey~$merchanId~$reference~$total~COP";
                $signature=md5($presignature);
            }
            $tipoPago=collect($tipoPago)->where('id',$order['payment_type_vp'])->pop();
            $orderState=collect($orderState)->where('id',$order['order_state'])->pop();
            $paymentState=collect($paymentState)->where('id',$order['payment_state'])->pop();
            $state=$request->transactionState??-1;
            return view('system.templates.user.pedido',['randy'=>$randy,'paymentState'=>$paymentState,'orderState'=>$orderState,'state'=>$state,'order'=>$order,'commerce'=>$commerce,'tipoPago'=>$tipoPago,'signature'=>$signature,'allProducts'=>'', 'distributor' => $distributor]);
        }
        return back();


    }
}
