@extends('system.layouts.global.index')
@section('title', 'Detalle del pedido')

@section('css')
<link href="{{ asset('assets/css/styles.css')}}" rel="stylesheet" />
@endsection

@section('content')
<!-- Header -->
<div class="container mt-5">
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-8">
                <h3 class="mt-5 pt-3 mb-2 ml-3"><strong>Detalle del pedido</strong> (Estado: <b class="text-info">{{$orderState['name']}}</b>)</h3>
                @if ($state!=-1)
                @if($state == 4 )
                    <div class="alert alert-info" role="alert">
                      Compra Aprobada
                   </div>
                @endif

                @if ($state == 6 )
                    <div class="alert alert-danger" role="alert">
                       Compra Rechazada
                   </div>
                @endif

                @if ($state == 104 )
                    <div class="alert alert-danger" role="alert">
                       Error en la compra
                   </div>
                @endif

                @if ($state == 7 )
                    <div class="alert alert-warning" role="alert">
                       Transaccion pendiente
                   </div>
                @endif


            @endif


                <div class="container-fluid bg-white" id="container_expands">
                    <div class="container">
                    <h4 class="pt-3 ml-2 mb-0"><b>Cliente: </b> {{session('active_user.get_user.name').' '.session('active_user.get_user.lastname') }}</h4><br>
                    <h4 class="pt-1 ml-2 mb-0"><b>Comercio/Restaurante: </b>{{$commerce['bussiness_name']}}</h4><br>
                    <h4 class="pt-1 ml-2 mb-0"><b>Dirección: </b>{{$order['address']}}</h4><br>
                    <h4 class="pt-1 ml-2 mb-0"><b>Pedido entregado el: </b>{{$order['date']}}</h4><br>
                    @if($distributor != null)
                    <h4 class="pt-1 ml-2 mb-0"><b>Distribuidor : </b>{{$distributor['distributor_code']}}</h4><br>
                    @endif
                    </div>
                </div>
                <div class="container-fluid bg-white mt-4" id="container_expands">
                    <div class="container">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="float-left pt-3"><b>Tus productos</b></h4>
                                </div>
                            </div>
                            <div class="row">
                            <div class="bg-light p-3 pt-0 mb-3" style="max-height: 250px !important; overflow-y: auto !important;">

                                @foreach ($order['get_order_details'] as $item)
                                @php
                                    $allProducts.=$item['name']." x".$item['quantity']." |";
                                @endphp
                              <div class="row border-bottom">
                              <div class="col-md-2 col-3 my-auto">
                                    <div class="avatar text-center" style="height: 50px !important;">
                                    <img class="media-object img-raised" src="{{config('app.url_apiRequest').'storage/'.$item['get_product']['img_product']}}" alt="..." style="height: 90% !important;">
                                    </div>
                                </div>
                                <div class="col mx-0 my-auto">
                                <h6 class="text-dark py-0 my-0 mt-2">{{$item['name']}}</h6>
                                <p class="text-muted py-0 my-0" style="line-height: 1.1;"><strong>cantidad:</strong>{{$item['quantity']}} <strong>precio</strong>${{number_format($item['total_value'])}}</p>
                                </div>
                            </div>
                              @endforeach

                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-md-4 mt-5 mb-5" style="padding-top:15px">
                <div class="container mb-5">
                    <div class="container-fluid bg-white mt-4" id="container_expands">
                        <br>
                        <h5 class="mt-4"><b>Datos del Pago</b></h5>
                        <div class="row">
                            <div class="col-7">
                                <h5>Estado de pago</h5>
                                <h5>Tipo de pago</h5>
                                <h5>Valor entrega</h5>
                                <h5>Valor cupon</h5>
                                <h5>Propina</h5>
                                <h5>Costo de productos</h5>
                            </div>
                            <div class="col-5">
                            <h5 class="{{($paymentState['id']==21 ||$paymentState['id']== 19)?'text-danger font-weight-bold':'text-info font-weight-bold'}}" >{{$paymentState['name']}}<h5>
                                <h5>{{$tipoPago['name']}}</h5>
                                <h5>${{number_format($order['delivery_value'])}}</h5>
                                <h5>-${{number_format($order['coupon_value'])}}</h5>
                                <h5>${{number_format($order['tip_value'])}}</h5>
                                <h5>${{number_format($order['sub_total'])}}</h5>
                            </div>
                        </div>
                        <hr style="width:100%;">
                        <div class="row">
                            <div class="col-8 ">
                                <h5><strong>&ensp;Total</strong></h5>
                            </div>
                            <div class="col-4  pr-3 ">
                            <h5><strong>${{number_format($order['total'])}}</strong></h5>
                            </div>
                        </div>
                        <div class="row mb-0">
                          <div class="col-2"></div>
                          <div class="col-8">
                              <button class="btn btn-info float-center mb-1 btn-block p-3" onclick="replay({{$order['id']}})" type="button"><strong>Repetir pedido</strong></button>
                              @if ($paymentState['id']==21 ||$paymentState['id']== 19)
                                @include('system.templates.payment.payUform')
                              @endif
                          </div>
                          <div class="col-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

