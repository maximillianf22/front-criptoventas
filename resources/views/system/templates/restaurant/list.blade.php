@extends('system.layouts.global.index')
@section('title', 'Restaurantes')

@section('css')
<link href="{{ asset('assets/css/styles.css')}}" rel="stylesheet" />

@endsection

@section('content')
<!-- SECTION SLIDER -->
 <div class=" container-fluid p-0 m-0 bg-white">
  @include('system.layouts.global.components.slider')

  <div class="container-fluid ">
     <div class="row mt-5 wraps">
        <!-- sidebar -->
        <div class="sidebarr d-none d-sm-none d-md-block ml-4 shadow-sm" style="margin-top: 0px" style="margin-top: 35px;">
           <div class="list-group bg-white">
                <button type="button" class="list-group-item list-group-item-action ">
                  <strong>Filtrar por:</strong>
                </button>
               @foreach ($categories as $item)
                  <a   href="{{route('restaurantes',['id'=>9,'cat'=>$item->id])}}" type="button"  data-lodingTitle='<h1 class="mt-4 text-center text-info font-weight-light display-3">Restaurantes y <strong class="text-secondary"><b>Cafeterías</b></strong> cerca de ti</h1>' class="list-group-item list-group-item-action showLoading {{request()->segment(3)==$item->id?'active': ''}}">
                    {{$item->name}}
                  </a>
               @endforeach
           </div>
        </div>
        <div class="mains">
            <div class="container">
               <h1 class="mt-4 text-center text-info font-weight-light display-3">Restaurantes y <strong class="text-secondary"><b>Cafeterías</b></strong> cerca de ti</h1>
               <!-- buscadpr -->
                  <div class="row mb-3 mt-4">
                     <div class="col-2"></div>
                     <div class="col-8 shadow-sm border bg-white rounded text-nowrap input-group">
                        <div class="input-group-prepend d-block d-sm-block d-md-none d-lg-none">
                          <span class="input-group-text  mr-3 mt-1" style="border: 0px solid #cad1d7;">
                            <i class="fas fa-search text-info mt-1"></i>
                          </span>
                        </div>
                        <input type="text" id="inputBuscador" class="form-control input-lg  text-dark mt-2" placeholder="Busca tu restaurante favorito" style="    border: 0px solid #cad1d7;">
                        <div class="input-group-append d-none d-sm-none d-md-block d-lg-block">
                           <button class="btn btn-info mt-2 mb-2 shadow-sm" type="button"><i class="fas fa-search"></i></button>
                        </div>
                     </div>
                     <div class="col-2"></div>
                  </div>
                <!-- Retaurantes -->
                @foreach($restaurants as $restaurant)
                <h2 class="mb-2">{{$restaurant['name']}}</h2>
                 <div class="grid_items">
                 @foreach ($restaurant['get_commerces'] as $item)
                   <div class="grid_item cardProduct" style="max-height: 140px;height: 140px; min-height: 140px;">
                     <a class="showLoading" href="{{route('restaurante',['id'=>$item['id']])}}">
                      @if($item['get_user']['photo'] != 'default.png')
                      <div class="grid_img" style="background-image: url('{{config('app.url_apiRequest')}}storage/{{$item['get_user']['photo']}}')"></div>
                      @else
                      <div class="grid_img" style="background-image: url({{asset('assets/img/aliado.png')}});"></div>
                      @endif
                      <div class="caption">
                         <h4 class="text-dark text-left mb-0">
                             <div class="row">
                                 <div class="col-8 pr-0 ml-0">
                                 <strong class="name-producto">{{$item['bussiness_name']}}</strong>
                                 </div>
                                 <div class="col-3 px-0 mx-0">

                                </div>
                            </div>
                         </h4>
                        <h5 class="text-muted text-left mb-0">{{$restaurant['name']}}</h5>
                        {{--  <p><span class="badge badge-danger rounded">50% Descuentos</span></p> --}}
                        <span class="time"><i class="fa fa-clock"></i> {{$item['is_opened'] == 0 ? 'Cerrado' : 'Abierto'}}</span>
                         <span class="price-content">
                         <span class="dot-separator">●
                            @if ($item['delivery_config']==13 && empty(session('active_user')))
                            <span class="badge badge-info rounded">
                            <i class="fas fa-price"></i> Variable  </span>
                            @else
                            @if ($item['delivery_config']==13 &&  empty(session('dir')))
                            <span class="badge badge-info rounded">
                                <i class="fas fa-price"></i>  variable
                             </span>
                            @else
                            <span class="badge badge-info rounded">
                                <i class="fas fa-price"></i>  {{($item['delivery_value']>0)?'$'.number_format($item['delivery_value']):'gratis'}}
                             </span>
                            @endif
                            @endif
                         </span>

                         </span>
                      </div>
                     </a>
                   </div>
                 @endforeach
                </div>
                 @endforeach
               <div class="row">
                 <div class="col-3 mx-auto mt-3">
                    <button class="btn btn-info " type="button">Ver más</button>
                 </div>
               </div>
            </div>
        </div>
     </div>
  </div>
@endsection
@section('js')
    <script>
          $('#inputBuscador').keyup(() => {
            if ($('#inputBuscador').val().length > 0) {
                    let input = $('#inputBuscador').val()
                    let cardProduct=$('.cardProduct')
                    cardProduct.each(function(){
                        let productName = $(this).find('.name-producto').text();
                        let regex= new RegExp(`${input}`,"i")
                        if (productName.search(regex)==-1) {
                            $(this).css('display', 'none');
                        }else{
                            $(this).css('display', 'block');
                        }
                    });


            }else{
                $('.cardProduct').css('display','block')
            }
        })
    </script>
    <script type="text/javascript">
  $('.owl-head').owlCarousel({
      loop: true,
      margin: 0,
      autoplay: true,
      autoplayTimeout: 4000,
      animateOut: 'fadeOut',
      autoplayHoverPause: true,
      responsiveClass: true,
      responsive: {
          0: {
              items: 1,
              loop: true,
              nav: false
          },
          600: {
              items: 1,
              loop: true,
              nav: false
          },
          1100: {
              items: 1,
              loop: true,
              nav: false
          }

      }
  })
</script>
@endsection
