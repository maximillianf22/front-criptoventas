<div class="container p-4">

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
