@extends('system.layouts.global.index')
@section('title', 'Tiendas')

@section('content')
<!-- Section slider-->
  <div class=" container-fluid p-0 m-0 bg-white">
  @include('system.layouts.global.components.slider')
<!-- Section title-->
<div class="container shadow-sm bg-white d-none d-sm-none d-md-block d-lg-block mt-4 rounded">
  <div class="row mt-2">
    <div class="col-md-2 col-0"></div>
    <div class="col-md-8 col-12">
      <h1 class="text-info display-3 text-center mt-3 mb-3">Seguro <strong class="text-secondary">encontrarás</strong> lo que buscas</h1>
    </div>
    <div class="col-md-2 col-0"></div>
  </div>
  <!-- Section filters-->
  <ul class="nav justify-content-center nav nav-pills nav-fill flex-column flex-sm-row mb-0">
    @foreach($categories as $category)
    <li class="nav-item mx-auto pr-0" style="border-bottom: .1rem solid #df0024!important;">
      <a data-lodingTitle='<h1 class="mt-4 text-center text-info font-weight-light display-3">Seguro <strong class="text-secondary"><b>encontrarás </b></strong> lo que buscas</h1>' class="nav-link bg-white mb-0 mt-1 hovertext no-border-radius showLoading  {{$category->id==$id? 'active':''}}" href="{{route('supermercados',['id'=>10,'cat'=>$category->id])}}"><strong class="text-dark">{{$category->name}}</strong></a>
    </li>
    @endforeach
  </ul>
</div>
<!-- Section Supermarket -->
<div class="container-fluid">
  <div class="row">
    <div class="container-fluid mt-4 rounded">
      <div class="row mx-auto mt-0">
        @php
        $i=0;
        @endphp

        @foreach ($superMarkets as $item)
        <div class="col-md-4 col-lg-3 col-xl-3 col-6 m-0 p-1">
          <a class="showLoading" href="{{route('supermercado', ['id'=>$item['id']])}}">
            <div class=" card card-blog mx-auto card-background categories" data-animation="true">
              @if($item['get_user']['photo'] != 'default.png')
                <div class="full-background" style="background-image: url('{{config('app.url_apiRequest')}}storage/{{$item['get_user']['photo']}}')"></div>
              @else
                <div class="full-background" style="background-image: url({{asset('assets/img/aliado.png')}}); background-repeat: no-repeat; background-size: contain"></div>
              @endif
              <div class="card-body">
                <div class="row">
                  <div class="col-10 mx-auto mt-3">
                    <div class="stats stats-right mt-5">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <p class="text-center mb-0">
              <span class="badge {{$item['is_opened']==0?'badge-danger':'badge-info'}}  rounded">
                <i class="fas fa-clock"></i> {{$item['is_opened']==0?'Cerrado':'Abierto'}} </span>
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

            </p>
            <h4 class="text-dark text-center mb-0"><strong>{{$item['bussiness_name']}}</strong></h4>

          </a>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
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


@section('footer')
@include('system.layouts.global.components.footer')
@endsection
