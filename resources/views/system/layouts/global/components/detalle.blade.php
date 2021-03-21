@if (session()->has('commerce'))

<nav aria-label="breadcrumb">
  <ol class="breadcrumb bg-white">
    @php
    $ruta1="";
    $ruta2="";
    if (session('commerce.commerce_type_vp')==10) {
    $ruta1=route('supermercados',['id'=>10]);
    $ruta2=route('supermercado',['id'=>10,'cat'=>session('commerce.id')]);
    }else {
    $ruta1=route('restaurantes',['id'=>9]);
    $ruta2=route('restaurante',['id'=>9,'cat'=>session('commerce.id')]);
    }
    @endphp
    <li class="breadcrumb-item"><a
        href="{{$ruta1}}"><strong>{{session('commerce.commerce_type_vp')==10?'SuperMercado':'Restaurante'}}</strong></a>
    </li>
    <li class="breadcrumb-item active" aria-current="page"><a
        href="{{$ruta2}}"><strong>{{session('commerce.bussiness_name')}}</strong></a></li>
  </ol>
</nav>
@endif
@foreach ($Cart as $item)
<div class="row border-bottom mt-2">
  <div class="col-md-2 col-3 my-auto">
    <div class="avatar text-center" style="height: 50px !important;">
      <img class="media-object img-raised" src=" {{$item->options['img']}}" alt="..." style="height: 90% !important;">
    </div>
  </div>
  <div class="col-md-5 col-6 px-0 mx-0 my-auto">
    <h6 class="text-dark py-0 my-0 mt-2">{{$item->name}} <small class="text-gray">(${{number_format($item->price)}}
        {{isset($item->options['unit'])?$item->options['unit']:'UND'}})</small></h6>
    <p class="text-muted py-0 my-0" style="line-height: 1.1;"> {{$item->options['des']}}</p>
  </div>
  <div class="col-md-3 col-3 px-0 mx-0 my-auto">
    <td class="td-number">
      <div class="btn-group align-content-center" style="white-space: nowrap;">
        <button onclick="addToCart('{{$item->rowId}}','-')" class="btn btn-info btn-sm px-2"> <i
            class="fas fa-minus text-white"></i> </button>
        <p class="px-2 mt-1 bg-white">{{$item->qty}}</p>
        <button onclick="addToCart('{{$item->rowId}}','+')" class="btn btn-info btn-sm px-2"> <i
            class="fas fa-plus text-white"></i> </button>
      </div>
    </td>
  </div>
  <div class="col-md-2 col-12 px-0 mx-0 my-auto mx-auto">
    <p class="text-center"><strong>${{number_format($item->price*$item->qty)}}</strong></p>
  </div>
</div>
@endforeach