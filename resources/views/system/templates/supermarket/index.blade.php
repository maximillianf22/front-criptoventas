@extends('system.layouts.global.index')
@section('title', $superMarket->bussiness_name)

@section('content')
<!-- header -->
<div class="">
    <div class="wrapper">
        <div>

        </div>
    </div>
    <!-- Header -->
    <div class="container-fluid ">
        <div class="row mt-5 wraps">
            <!-- Sidebar -->
            <div class="sidebars d-none d-sm-none d-md-block ml-4" style="margin-top: 0 !important">
                <div class="card card-profile profile-bg">
                    @if($superMarket->get_user->photo != 'default.png')
                    <div class="card-header"
                        style="background-image: url('{{ config('app.url_apiRequest') }}storage/{{ $superMarket->get_user->photo }}')">
                    </div>
                    @else
                    <div class="card-header"
                        style="background-image: url({{asset('assets/img/aliado.png')}}); background-size: contain; background-repeat: no-repeat;">
                    </div>
                    @endif
                    <div class="card-body pt-0">
                        <h3 class="card-title">{{ $superMarket->bussiness_name }}</h3>
                        @if ($superMarket->is_opened == 0)
                        <span class="badge badge-danger  rounded">
                            <i class="fas fa-clock"></i> Cerrado</span>

                        @else
                        <span class="badge badge-info  rounded">
                            <i class="fas fa-clock"></i> Abierto</span>

                        @endif
                    </div>
                </div>
                <div class="list-group bg-white">
                    <a data-lodingTitle='<h1 class="mt-4 text-center text-info font-weight-light display-3">Supermercado <strong class="text-secondary"><b>{{ $superMarket->bussiness_name }}</b></strong> productos Cargando ..</h1>'
                        href="{{ route('supermercado', ['id' => $superMarket->id]) }}" type="button"
                        class="showLoading list-group-item list-group-item-action {{ request()->is('supermercado/' . $superMarket->id) ? 'active' : '' }}">
                        Categorias
                    </a>
                    @foreach ($Tcategories as $item)
                    @isset($item['subcategories'])
                    <div class="btn-group dropup">
                        <a type="button" class="list-group-item list-group-item-action dropdown-toggle"
                            style="color: #525f7f" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$item['name']}}
                        </a>
                        <div class="dropdown-menu">
                            @foreach($item['subcategories'] as $itemsub)
                            <a href="{{ route('supermercado', ['id' => $superMarket->id, 'cat' => $itemsub['id']]) }}"
                                type="button"
                                data-lodingTitle='<h1 class="mt-4 text-center text-info font-weight-light display-3">Supermercado <strong class="text-secondary"><b>{{ $superMarket->bussiness_name }}</b></strong> productos Cargando..</h1>'
                                class="showLoading list-group-item list-group-item-action  {{ request()->segment(3) == $itemsub['id'] ? 'active' : '' }}">
                                {{ $itemsub['name'] }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @else

                    <a href="{{ route('supermercado', ['id' => $superMarket->id, 'cat' => $item['id']]) }}"
                        type="button"
                        data-lodingTitle='<h1 class="mt-4 text-center text-info font-weight-light display-3">Supermercado <strong class="text-secondary"><b>{{ $superMarket->bussiness_name }}</b></strong> productos Cargando..</h1>'
                        class="showLoading list-group-item list-group-item-action  {{ request()->segment(3) == $item['id'] ? 'active' : '' }}">
                        {{ $item['name'] }}
                    </a>


                    @endisset
                    @endforeach
                </div>
            </div>
            <div class="mains">
                <div class="bg-white">
                    <div class="owl-carousel owl-head owl-theme owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                @isset($sliders)
                                @foreach ($sliders as $item)
                                @if($item['commerce_id'] == $superMarket->id)
                                @if($item['state'] == 1)
                                <div class="owl-item col-lg-4 col-md-3 col-sm-4 col-6 p-0" data-animation="zooming">
                                    <div class="item">
                                        <div class="card-product m-0">
                                            <div class="card-image">
                                                @isset($item['redirect_url'])
                                                <a href="#" onclick="validateURL('{{$item['redirect_url']}}')"><img
                                                        style="height: 200px"
                                                        src="{{ config('app.url_apiRequest') . 'storage/' . $item['url'] }}"
                                                        class="shad border-radius" alt="..."></a>
                                                @else
                                                <img style="height: 200px"
                                                    src="{{ config('app.url_apiRequest') . 'storage/' . $item['url'] }}"
                                                    class="shad border-radius" alt="...">
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endif
                                @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Buscador -->
                <div class="container">
                    <div class="row mb-3 mt-4">
                        <div class="col-2"></div>
                        <div class="col-8 shadow-sm border bg-white rounded text-nowrap input-group">
                            <div class="input-group-prepend d-block d-sm-block d-md-none d-lg-none">
                                <span class="input-group-text  mr-3 mt-1" style="border: 0px solid #cad1d7;">
                                    <i class="fas fa-search text-info mt-1"></i>
                                </span>
                            </div>
                            <input id="inputBuscador" type="text" class="form-control input-lg  text-dark mt-2"
                                placeholder="Busca tu producto" style="    border: 0px solid #cad1d7;">
                            <div class="input-group-append d-none d-sm-none d-md-block d-lg-block">
                                <button class="btn btn-info mt-2 mb-2 shadow-sm" type="button"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
                <!-- Productos y categorias -->

                <div class="container-fluid containerProduct">
                    @if (count($offers) > 0)

                    <h3 class="title mt-3">Ofertas del día</h3>
                    @endif

                    <div class="row">
                        @foreach ($offers as $offer)
                        <div class="col-md-3 col-lg-2 col-xl-2 col-6 mx-0 p-1 cardProduct" {!! isset($offer['value']) ?
                            ($superMarket->is_opened ? 'onclick="showProduct(' . $offer['get_product']['id'] . ')"'
                            : 'onclick="cerrado()"') : '' !!} style="cursor: pointer;">
                            <div class="sc-item-store bg-white border shadow-sm">
                                <div class="categorie">
                                    <div class="sticky"></div>
                                    <div class="offer text-white font-weight-bold">
                                        <strong>{{ $offer['discount'] }}<small>%</small></strong>
                                    </div>
                                    <div class="media p-2">
                                        <img id="logoTheme"
                                            src="{{ config('app.url_apiRequest') }}storage/{{ $offer['get_product']['img_product'] }}"
                                            alt="Producto" class="producto align-self-center img-fluid mx-auto">
                                    </div>
                                    <div class="info-article">
                                        <div class="name-producto font-weight-bold text-center"
                                            style="line-height: 1.1 !important">{{ $offer['get_product']['name'] }}
                                        </div>
                                        <div class="d-flex justify-content-center bg-white">
                                            <span class="badge badge-info rounded text-center">
                                                {{ $offer['get_product']['get_market_product']['get_unit']['name'] }}
                                            </span>
                                        </div>
                                        <div class="info-price">
                                            <div class="item-price p-1 text-center text-info">
                                                <span class="price-content">
                                                    <span
                                                        class="text-dark"><s>${{ number_format($offer['value']) }}</s></span>
                                                    <strong><span
                                                            class="text-danger">${{ number_format($offer['value'] * (1 - $offer['discount'] / 100)) }}</span></strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                    @if (count($outstanding) > 0)

                    <h3 class="title mt-3">Destacados de hoy</h3>
                    @endif

                    <div class="row">
                        @foreach ($outstanding as $offer)
                        <div class="col-md-3 col-lg-2 col-xl-2 col-6 mx-0 p-1 cardProduct" {!! isset($offer['value']) ?
                            ($superMarket->is_opened ? 'onclick="showProduct(' . $offer['get_product']['id'] . ')"'
                            : 'onclick="cerrado()"') : '' !!} style="cursor: pointer;">
                            <div class="sc-item-store bg-white border shadow-sm">
                                <div class="categorie">
                                    <div class="sticky"></div>
                                    <div class="offer text-white font-weight-bold">
                                        <strong style="margin-left: -1px;">Hoy</small></strong>
                                    </div>
                                    <div class="media card-producto p-2">
                                        <img id="logoTheme"
                                            src="{{ config('app.url_apiRequest') }}storage/{{ $offer['get_product']['img_product'] }}"
                                            alt="Producto" class="producto align-self-center img-fluid mx-auto">
                                    </div>
                                    <div class="info-article">
                                        <div class="name-producto font-weight-bold text-center"
                                            style="line-height: 1.1 !important">{{ $offer['get_product']['name'] }}
                                        </div>
                                        <div class="d-flex justify-content-center bg-white">
                                            <span class="badge badge-info rounded text-center">
                                                {{ $offer['get_product']['get_market_product']['get_unit']['name'] }}
                                            </span>
                                        </div>
                                        <div class="info-price">
                                            <div class="item-price p-1 text-center text-info">
                                                <span class="price-content">
                                                    <span class="text-dark">${{ number_format($offer['value']) }}</span>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="container-fluid m-0 p-0" style="border-top:0px solid #F1F3F4; min-height: 50vh">
                        @foreach ($categories as $itemC)
                        <div class="containerProduct">
                            @if (count($itemC->get_product_categories) > 0)
                            <h3 class="title mt-3">{{ $itemC->name }}</h3>
                            @endif
                            <div class="row">
                                @foreach ($itemC->get_product_categories as $item)
                                @if (isset($item->value))
                                <div {!! $superMarket->is_opened ? 'onclick="showProduct(' .
                                    $item->get_product->id . ')"' : 'onclick="cerrado()"' !!}
                                    class="col-md-3 col-lg-2 col-xl-2 col-6 mx-0 p-1 cardProduct" style="cursor:
                                    pointer;">
                                    <div class="sc-item-store bg-white border shadow-sm ">
                                        <div class="categorie">
                                            <div class="media card-producto p-2">
                                                <img id="logoTheme"
                                                    src="{{ config('app.url_apiRequest') }}storage/{{ $item->get_product->img_product }}"
                                                    alt="Producto" class="producto align-self-center img-fluid mx-auto">
                                            </div>
                                            <div class="info-article">
                                                <div class="name-producto font-weight-bold text-center"
                                                    style="line-height: 1.1 !important">
                                                    {{ $item->get_product->name }}</div>
                                                <div class="d-flex justify-content-center bg-white">
                                                    <span class="badge badge-info rounded text-center">
                                                        {{ $item->getUnit->name }}
                                                    </span>
                                                </div>
                                                <div class="info-price">
                                                    <div class="item-price p-1 text-center text-info">
                                                        @if (isset($item->value->value))
                                                        @if (!is_null($item->value->discount))
                                                        <span><s>{{ '$' . number_format($item->value->value) }}</s></span>
                                                        <strong><span
                                                                class="text-danger">{{ '$' . number_format($item->value->discount) }}</span></strong>
                                                        @else
                                                        <strong>{{ '$' . number_format($item->value->value) }}</strong>
                                                        @endif
                                                        @else
                                                        <strong>No disponible</strong>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-3 col-lg-2 col-xl-2 col-6 mx-0 p-1" style="cursor: pointer;">
                                    <div class="sc-item-store bg-white border shadow-sm">
                                        <div class="categorie">
                                            <div class="media card-producto p-2">
                                                <img id="logoTheme"
                                                    src="{{ config('app.url_apiRequest') }}storage/{{ $item->get_product->img_product }}"
                                                    alt="Producto" class="producto align-self-center img-fluid mx-auto">
                                            </div>
                                            <div class="info-article">
                                                <div class="name-producto font-weight-bold text-center"
                                                    style="line-height: 1.1 !important">
                                                    {{ $item->get_product->name }}</div>
                                                <div class="d-flex justify-content-center bg-white">
                                                    <span class="badge badge-info rounded text-center">
                                                        {{ $item->getUnit->name }}
                                                    </span>
                                                </div>
                                                <div class="info-price">
                                                    <div class="item-price p-1 text-center text-info">
                                                        <strong>{{ isset($item->value) ? '$' . number_format($item->value->value) : 'No disponible' }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif
                                @endforeach

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal bd-example-modal-lg" id="modalSuperMarket" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row modal-body">
                <div class="col-md-6 mx-auto justify-content-center text-center my-auto">
                    <img data-route="{{ config('app.url_apiRequest') }}storage/" alt="..."
                        class="align-self-center mr-3 product-img" style="min-width: 20vh; max-height: 45vh;">
                </div>

                <div class="col-md-6 mx-auto justify-content-center text-center">
                    <div class="container text-left mb-5">
                        <div class="display-4 font-weight-bold product-title">Producto</div>
                        <div class="display-6 lead  text-muted mt-0 product-des">Descripcion </div>
                        Minimo a comprar
                        <span id="minimoProductC">1</span>
                        <div class="display-6 lead  text-muted mt-0 "></div>
                        <div class="row">
                            <div class="col-6">
                                <div class="display-5 font-weight-bold text-danger mt-1  "> <span
                                        class="product-price"></span> <s id="product-price-discounted"
                                        class="text-info"></s> <span id="product-price-discount"></span> </div>

                            </div>
                            <div class="col-6">
                                <div class="btn-group align-content-center" style="white-space: nowrap;">
                                    <button class="btn btn-info btn-sm px-2 restProduct"> <i
                                            class="fas fa-minus text-white"></i> </button>
                                    <p class="px-2 mt-1 bg-white countProduct">1</p>
                                    <button class="btn btn-info btn-sm px-2 addProduct"> <i
                                            class="fas fa-plus text-white"></i> </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col ml-1">
                                <strong id="quantityContent"></strong>
                            </div>
                        </div>
                        <div class="display-5 font-weight-bold mt-1 title-variaciones">Variaciones</div>
                        <div id="variaciones">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pad-all text-center mt-1 mx-auto">
                <button data-product="" id="addProduct" class=" btn btn-info btn--modal-theme text-center"> <i
                        class="lni lni-cart"></i> <span id="total" data-uprice="0"></span> Agregar a la cesta </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    comercio = {{$superMarket-> id}}
        var producto = null;
        var cacheProducto = null;
        var minimo = null
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
        $('.owl-head').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    loop: true,
                    nav: true
                },
                600: {
                    items: 2,
                    loop: true,
                    nav: false
                },
                1100: {
                    items: 3,
                    loop: true,
                    nav: false
                }

            }
        })
        function validateURL(str){
        
        if(!(str == "")){
        var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
        if (!(!!pattern.test(str))){
          window.open('/redirect/error')
        }else{
         window.open(str);
        }
  }
    }
        //muestra el modal de super mercado
        function showProduct(id) {

            fetch('/product/' + id, {
                    method: "get"
                }).then(response => response.json())
                .then((data) => {
                    console.log(data)
                    let product = data.data
                    cacheProducto = data.data;
                    $('#product-price-discount').text("");
                    $('#product-price-discounted').text("");
                    $('.product-price').text("");
                    $('.countProduct').text(product.value.min)
                    $('#variaciones').empty();
                    $('.product-title').text(product.name)
                    $('#quantityContent').text(product.get_market_product.quantity_content == null ? product
                        .get_market_product.quantity_content : '1' + ' ' + product.getUnit.name)
                    $('.product-des').text(product.description)
                    if (product.value.discount != null) {
                        $('#product-price-discount').text('$' + product.value.discount.toLocaleString('en'))
                        $('#product-price-discounted').text('$' + product.value.value.toLocaleString('en'))
                        $('#total').attr('data-uprice',product.value.discount )
                        $('#total').text('$'+product.value.discount.toLocaleString('en'))
                    } else {
                        $('.product-price').text('$' + product.value.value.toLocaleString('en'))
                        $('#total').attr('data-uprice',product.value.value)
                        $('#total').text('$'+product.value.value.toLocaleString('en'))
                    }

                    $('.product-img').prop('src', $('.product-img').data('route') + product.img_product)
                    $('#minimoProductC').text(product.value.min)
                    producto = product.id;
                    minimo = product.value.min;
                    let variaciones = product.get_market_product.get_product_variations;
                    if (variaciones.length == 0) {
                        $('.title-variaciones').text('')
                    } else {
                        $('.title-variaciones').text('Variaciones')
                    }
                    variaciones.forEach((item, index) => {

                        let rowVariaciones = `
                <div id="item-checked-108 mt-2" class="checkbox">
                         <input ${item.value==null?'disabled':''} data-nameproduct="${item.get_product.name}" data-idVariacion="${item.get_product.id}" data-des="${item.get_product.description}" data-index="${index}" class="checkVariaciones" type="checkbox" >
                         <label for="listProduct_108" style="font-size:12px; line-height:16px; width:70%"><b style="font-weight: bold">${item.get_product.name}</b>
                          <span id="quantityVariacion">${item.quantity_content +' '+item.get_unit.name}</span>
                         <br>   ${item.value==null?'No disponible':item.value.discount!=null?`<s class"text-info"">$ ${item.value.value}</s>| $${item.value.discount}`:'$'+item.value.value}
                         </label>
                 </div>
                `
                        $('#variaciones').append(rowVariaciones);
                    })

                    $('#modalSuperMarket').modal("show");

                })
        }

        // funcion que agrega al carrito productos
        function productCart(idCommerce, idProduct, qty, aditionals) {
            console.log(idCommerce, idProduct, aditionals)
            let data = {
                commerce: idCommerce,
                Product: idProduct,
                qty: qty,
                aditionals: aditionals,
                img: cacheProducto.img_product
            }
            fetch('/carrito', {
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then((response) => {

                    if (!response.ok) {
                        return Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Termine compra o vacie carrito para comprar aqui',
                            showConfirmButton: false,
                            timer: 2500
                        })
                    }
                    response.json().then((data) => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'producto agregado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('#cartCounter').text(data['counter'])
                        window.location.reload()
                    })
                })

        }
        $('#addProduct').click(() => {
            let cantidad = Number($('.countProduct').text());
            if (cantidad >= minimo) {
                let adicionales = $('#adicionalsProduct').val();
                productCart(comercio, producto, cantidad, adicionales);
                $('.bd-example-modal-lg').modal("hide");
            } else {
                Swal.fire({
                    position: 'top-end',
                    icon: 'info',
                    title: 'Debes escoger minimo ' + minimo + 'productos',
                    showConfirmButton: false,
                    timer: 1500
                })
            }

        })
        $('body').on('change', '.checkVariaciones', function() {
            let counted=Number($('.countProduct').text());
            if ($(this).prop('checked')) {
                $('.checkVariaciones').each(function() {
                    $(this).prop('checked', false)
                });
                $(this).prop('checked', true);
                let index = Number($(this).attr('data-index'));
                let product = cacheProducto.get_market_product.get_product_variations[index];
                $('.product-price').text('$' + product.value.value)
                $('.product-title').text(product.get_product.name)
                if (product.value.discount != null) {
                    $('.product-price').text('');
                    $('#product-price-discounted').text('$' + product.value.value)
                    $('#product-price-discount').text('$' + product.value.discount)
                    $('#total').attr('data-uprice',product.value.discount)
                } else {
                    $('#product-price-discounted').text('')
                    $('#product-price-discount').text('')
                    $('.product-price').text('$' + product.value.value);
                    $('#total').attr('data-uprice',product.value.value)
                }

                minimo = product.value.min;
                producto = product.product_id;
                let total=$('#total').attr('data-uprice')
                $("#total").text(Number(counted)*Number(total))
                $('#minimoProductC').text(product.value.min);
            } else {
                let product = cacheProducto;
                $('.product-title').text(product.name)
                minimo = product.value.min;
                producto = product.id;
                if (product.value.discount != null) {
                    $('.product-price').text('');
                    $('#product-price-discounted').text('$' + product.value.value)
                    $('#product-price-discount').text('$' + product.value.discount)
                    $('#total').attr('data-uprice',product.value.discount)
                } else {
                    $('#product-price-discounted').text('')
                    $('#product-price-discount').text('')
                    $('.product-price').text('$' + product.value.value);
                    $('#total').attr('data-uprice',product.value.value)
                }
                $('#minimoProductC').text(product.value.min);
            }
                let total=$('#total').attr('data-uprice')
                $("#total").text("$"+(Number(counted)*Number(total)).toLocaleString('en'))

        })

</script>
@endsection