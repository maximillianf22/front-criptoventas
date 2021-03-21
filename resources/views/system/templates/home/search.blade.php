@extends('system.layouts.global.index')
@section('title', 'Buscador')

@section('css')
<style>
   .card-background.card-blog {
    height: 120px;
    min-height: 120px;
    max-height: 120px;
    max-width: 120px;
}
.card-background:after {
    height: 0% !important;
}
.mains{
   margin-top: -100px !important;
   top: -100px !important;
}
</style>
@endsection

@section('content')
<!-- Main content -->
<!-- Header -->
<div class="container-fluid" style="padding-top:100px">
   <div class="row mt-5 wraps">
      <!-- Sidebar -->
      <div class="sidebars d-none d-sm-none d-md-block ml-4 mt-5">
         <div class="list-group bg-white mt-5">
            <button type="button" class="list-group-item list-group-item-action active">
               Filtrar por:
            </button>
            <a href="{{route('buscador',['commerceType'=>10]).'?keyWord='.request()->keyWord}}"  class="list-group-item list-group-item-action"><i class="fa fa-angle-right"></i> Supermercado</a>
            <a href="{{route('buscador',['commerceType'=>9]).'?keyWord='.request()->keyWord}}"  class="list-group-item list-group-item-action"><i class="fa fa-angle-right"></i> Restaurante</a>
         </div>
      </div>
      <div class="mains">
      <div class="container p-4 rounded bg-white">
            <div class="col-md-12 p-0">
               <div class="row row-cols-1 row-cols-md-3">
                  <h1 class="title font-weight-bold text-center ml-lg-4">Resultados en:</h1>
                  <div class="owl-carousel owl-products owl-theme owl-loaded owl-drag">
                     <div class="owl-stage-outer">
                        <div class="owl-stage">
                            @foreach ($data as $item)


                            <div class="owl-item mx-0 p-1 mx-1" style="cursor: pointer;">
                                <a href="{{$item['commerce_type_vp']==10?route('supermercado',['id'=>$item['id']]):route('restaurante',['id'=>$item['id']])}}">
                            <div class="card card-blog card-background rounded shadow-sm mx-auto" data-animation="zooming" style="    border-radius: 100px!important;">
                               <div class="full-background" style="background-image: url('{{config('app.url_apiRequest').'storage/'.$item['get_user']['photo']}}"></div>
                               </div>
                            <p class="text-center font-weight-bold mt-2">{{$item['bussiness_name']}}</p>
                        </a>
                            </div>
                            @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container p-4">
             @foreach ($data as $item)
             <div class="row m-2 border-top">
                <div class="col-6 display-4 text-uppercase text-info font-weight-bold mt-4 ">
                   {{$item['bussiness_name']}}
                </div>

             </div>
             <div class="col-md-12 p-0">
                <div class="row row-cols-1 row-cols-md-3">
                   <div class="owl-carousel owl-products owl-theme owl-loaded owl-drag">
                      <div class="owl-stage-outer">
                         <div class="owl-stage">
                             @foreach ($item['get_products'] as $catProducts)

                                    <div class="owl-item mx-0 p-1 mx-1" style="cursor: pointer;">
                                        <div class="sc-item-store bg-white rounded">
                                        <div class="categorie">
                                            <div class="media card-producto p-2">
                                            <img id="logoTheme" src="{{config('app.url_apiRequest').'storage/' .$catProducts['get_product']['img_product']}}" alt="Producto" class="producto align-self-center img-fluid mx-auto">
                                            </div>
                                            <div class="info-article">
                                                <div class="name-producto font-weight-bold text-center" style="line-height: 1.1 !important">{{$catProducts['get_product']['name']}}</div>
                                                <div class="d-flex justify-content-center bg-white">
                                                    @if ($item['commerce_type_vp']==10)

                                                    <span class="badge badge-info rounded text-center">
                                                        {{$catProducts['getUnit']['name']}}
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="info-price">
                                                    <div class="item-price p-1 text-center text-info">
                                                        @if(isset($catProducts['value']['value']))
                                                        @if(!is_null($catProducts['value']['discount']))
                                                        <span><s>{{'$' . number_format($catProducts['value']['value'])}}</s></span> <strong><span class="text-danger">{{'$' . number_format($catProducts['value']['discount'])}}</span></strong>
                                                        @else
                                                        <strong>{{'$'.number_format($catProducts['value']['value'])}}</strong>
                                                        @endif
                                                        @else
                                                        <strong>No disponible</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="p-2">
                                                <p class="text-center"><button id="btn-add-to-cart" class="btn btn-info btn-sm" data-commerce="{{$item['id']}}"  onclick="{{$item['commerce_type_vp']==10?'showProductSuperMarket('.$catProducts['get_product']['id'].')':'showProductRestaurant('.$catProducts['get_product']['id'].')'}}" >Agregar</button></p>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                             @endforeach
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             @endforeach
         </div>
      </div>
   </div>
</div>
@include('system.layouts.global.components.logicandmodals')
@endsection

