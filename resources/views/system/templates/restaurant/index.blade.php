@extends('system.layouts.global.index')
@section('title',   $restaurant->bussiness_name )

@section('css')
<link href="{{ asset('assets/css/styles.css')}}" rel="stylesheet" />
<style>
  .shadow-inside{
    -webkit-box-shadow: inset -2px -5px 32px -5px rgba(128,128,128,0.15);
    -moz-box-shadow: inset -2px -5px 32px -5px rgba(128,128,128,0.15);
    box-shadow: inset -2px -5px 32px -5px rgba(128,128,128,0.15);
  }

  @media (min-width: 992px){
.modal-lg, .modal-xl {
    max-width: 1000px;
}
}
</style>
@endsection

@section('content')
<!-- Header -->
{{-- <div class="wrapper">
  <div>
   <div class="container-fluid bg-white shadow" style="background-image: url('https://images5.alphacoders.com/988/thumb-1920-988453.jpgn'); background-size:cover;background-repeat:no-repeat;  background-position: center center; height: 45vh; z-index: 999999999;border-radius: 0px 0px 80px 80px;"><br>
    </div>
   </div>
</div> --}}
<div class="container-fluid ">
 <div class="row mt-5 wraps">
    <!-- sidebar -->
    <div class="sidebars d-none d-sm-none d-md-block ml-4" style="margin-top: 0 !important">
       <div class="card card-profile profile-bg">
        @if($restaurant->get_user->photo != 'default.png')
          <div class="card-header" style="background-image: url('{{config('app.url_apiRequest')}}storage/{{$restaurant->get_user->photo}}')">
          </div>
        @else
        <div class="card-header" style="background-image: url({{asset('assets/img/aliado.png')}}); background-size: contain; background-repeat: no-repeat;"></div>
        @endif
          <div class="card-body pt-0">
            <h3 class="card-title">{{$restaurant->bussiness_name}}</h3>
           @if ($restaurant->is_opened==0)
           <span class="badge badge-danger  rounded">
            <i class="fas fa-clock"></i> Cerrado</span>

            @else
            <span class="badge badge-info  rounded">
                <i class="fas fa-clock"></i> Abierto</span>

           @endif

        </div>
      </div>
       <div class="list-group bg-white">
         <a  href="{{route('restaurante',['id'=>$restaurant->id])}}" type="button" data-lodingTitle='<h1 class="mt-4 text-center text-info font-weight-light display-3">Restaurante <strong class="text-secondary"><b>{{$restaurant->bussiness_name}}</b></strong> Productos</h1>' class="list-group-item list-group-item-action showLoading  {{request()->is('restaurante/'.$restaurant->id)? 'active' : ''}}">
            Categorias
         </a>
         @foreach ($Tcategories as $item)
                            @isset($item['subcategories'])
                                <div class="btn-group dropup">
                                      <a type="button" class="list-group-item list-group-item-action dropdown-toggle" style="color: #525f7f" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{$item['name']}}
                                      </a>
                                      <div class="dropdown-menu">
                                        @foreach($item['subcategories'] as $itemsub)
                                         <a href="{{ route('restaurante', ['id' => $restaurant->id, 'cat' => $itemsub['id']]) }}"
                                            type="button"
                                            data-lodingTitle='<h1 class="mt-4 text-center text-info font-weight-light display-3">Restaurante <strong class="text-secondary"><b>{{ $restaurant->bussiness_name }}</b></strong> productos Cargando..</h1>'
                                            class="showLoading list-group-item list-group-item-action  {{ request()->segment(3) == $itemsub['id'] ? 'active' : '' }}">
                                            {{ $itemsub['name'] }}
                                        </a>
                                        @endforeach
                                      </div>
                                    </div>
                            @else
                            
                            <a href="{{ route('restaurante', ['id' => $restaurant->id, 'cat' => $item['id']]) }}"
                                type="button"
                                data-lodingTitle='<h1 class="mt-4 text-center text-info font-weight-light display-3">Restaurante <strong class="text-secondary"><b>{{ $restaurant->bussiness_name }}</b></strong> productos Cargando..</h1>'
                                class="showLoading list-group-item list-group-item-action  {{ request()->segment(3) == $item['id'] ? 'active' : '' }}">
                                {{ $item['name'] }}
                            </a>
                               
                            
                            @endisset
                        @endforeach
        </div>
    </div>
    <div class="mains">
        <div class="container">
          <div class="bg-white">
                        <div class="owl-carousel owl-head owl-theme owl-loaded owl-drag">
                            <div class="owl-stage-outer">
                                <div class="owl-stage">
                                    @isset($sliders)
                                    @foreach ($sliders as $item)
                                    @if($item['commerce_id'] == $restaurant->id)
                                        @if($item['state'] == 1)
                                        <div class="owl-item col-lg-4 col-md-3 col-sm-4 col-6 p-0" data-animation="zooming">
                                            <div class="item">
                                                <div class="card-product m-0">
                                                    <div class="card-image">
                                                        @isset($item['redirect_url'])
                                                          <a href="#" onclick="validateURL('{{$item['redirect_url']}}')"><img style="height: 200px"
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
        <h3>Precios y Menús de <strong>{{$restaurant->bussiness_name}}</strong></h3>
        @if (count($offers)>0)

        <h3 class="title mt-3">Ofertas del día</h3>
        @endif
        @foreach ($offers as $offer)
            <div class="col-md-3 col-lg-2 col-xl-2 col-6 mx-0 p-1" {!! isset($offer['value'])? $restaurant->is_opened?'onclick="showProduct('.$offer['get_product']['id'].')"' :'onclick="cerrado()"': ''!!} style="cursor: pointer;">
               <div class="sc-item-store bg-white border shadow-sm">
                  <div class="categorie">
                    <div class="sticky"></div>
                     <div class="offer text-white font-weight-bold">
                     <strong>{{$offer['discount']}}<small>%</small></strong>
                     </div>
                   </div>
                     <div class="media card-producto p-2">
                        <img id="logoTheme" src="{{config('app.url_apiRequest')}}storage/{{$offer['get_product']['img_product']}}" alt="Producto" class="producto align-self-center img-fluid mx-auto">
                     </div>
                     <div class="info-article">
                        <div class="name-producto font-weight-bold text-center" style="line-height: 1.1 !important">{{$offer['get_product']['name']}}</div>

                        <div class="info-price">
                           <div class="item-price p-1 text-center text-info">
                             <span class="price-content">
                             <span class="text-dark"><s>${{number_format($offer['value'])}}</s></span> <strong><span class="text-danger">${{number_format($offer['value']*(1-$offer['discount']/100))}}</span></strong>
                             </span>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>

               @endforeach

               @if (count($outstanding)>0)
                    <h3 class="title mt-3">Destacados de hoy</h3>
                @endif
               @foreach ($outstanding as $offer)
            <div class="col-md-3 col-lg-2 col-xl-2 col-6 mx-0 p-1" {!! isset($offer['value'])? $restaurant->is_opened?'onclick="showProduct('.$offer['get_product']['id'].')"' :'onclick="cerrado()"': ''!!} style="cursor: pointer;">
               <div class="sc-item-store bg-white border shadow-sm">
                  <div class="categorie">
                    <div class="sticky"></div>
                     <div class="offer text-white font-weight-bold">
                     <strong style="margin-left: -1px;">Hoy</strong>
                     </div>
                   </div>
                     <div class="media card-producto p-2">
                        <img id="logoTheme" src="{{config('app.url_apiRequest')}}storage/{{$offer['get_product']['img_product']}}" alt="Producto" class="producto align-self-center img-fluid mx-auto">
                     </div>
                     <div class="info-article">
                        <div class="name-producto font-weight-bold text-center" style="line-height: 1.1 !important">{{$offer['get_product']['name']}}</div>

                        <div class="info-price">
                           <div class="item-price p-1 text-center text-info">
                             <span class="price-content">
                             <span class="text-dark">${{number_format($offer['value'])}}</span>
                             </span>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>

               @endforeach
            </div>
        @foreach ($categories as $itemC)
        @if (count($itemC->get_product_categories)>0)
        <h4><b> {{$itemC->name}}</b></h4>
        @endif
        <div class="grid_items_view p-0">
        @foreach ($itemC->get_product_categories as $item)
       <div class="grid_items_view-md gap-sm" style="max-height: 140px;height: 140px; min-height: 140px;">
           <div class="grid_img" style="background-image: url('{{config('app.url_apiRequest')}}storage/{{$item->get_product->img_product}}')"></div>
           <div class="captionrest_view mt-3">
              <div class="col-10 ml-5 mx-auto">
                 <h4 class="text-dark text-left mb-0" style="line-height: 1.1">
                    <strong>{{$item->get_product->name}}</strong>
                 </h4>
                 <h5 class="text-muted text-left mb-0 text-responsive">{{$item->get_product->description}}</h5>
                 <h3 class="text-dark text-left mb-0">
                     <div class="row">
                         <div class="col-8 pr-0 ml-0">
                             <span class="price-content">
                              @if(isset($item->value->value))
                              @if(!is_null($item->value->discount))
                              <span><s>{{'$' . number_format($item->value->value)}}</s></span> <strong><span class="text-danger">{{'$' . number_format($item->value->discount)}}</span></strong>
                              @else
                              <strong>{{'$'.number_format($item->value->value)}}</strong>
                              @endif
                              @else
                              <strong>No disponible</strong>
                              @endif
                            </span>
                         </div>
                         <div class="col-3 pt-4 px-0 mx-0">
                             <button class="btn btn-info btn-sm ml-auto" type="button"   {!! isset($item->
                              value)?'onclick="showProduct('.$item->get_product->id.')"' :'' !!} style="bottom:30px">Agregar
                            </button>
                        </div>
                    </div>
                 </h3>
              </div>
           </div>
        </div>
        @endforeach
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalRestaurante" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="transform: translateY(13%);">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title"></h5>
              <button data-dismiss="modal" class="btn btn-neutral">
                <img src="{{ asset('assets/img/brand/close.png')}}" width="30%">
              </button>
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="row modal-body">
             <div class="col-md-6 mx-auto justify-content-center text-center">
             <img id="imageModalR"  data-route="{{config('app.url_apiRequest')}}storage/" alt="..." class="align-self-center mr-3 product-img" style="width: 55vh">
             </div>
             <div class="col-md-6 mx-auto justify-content-center text-center">
                <div class="container text-left mb-2">
                    <input type="hidden" id="totalUnit">
                   <div class="display-4 font-weight-bold product-title text-center"></div>
                   <div>
                    <h1 class="modal-title text-center font-wheigth-bold" id="exampleModalScrollableTitle">Categoria</h1>
                    <h5 class="text-muted text-center text-uppercase" id="desP">Descripcion del pollito plis</h5>
                    </div>
                   <div class="display-6 lead  text-muted mt-0 product-des text-center"></div>
                      <div id="ingredientesAll" class="container-fluid ml-1 shadow-inside" style="min-height: 300px;max-height: 300px; width: 100%; ; overflow-y: auto !important;">


                     </div>
                     <div class="row mt-3">
                      <div class="col-4">
                        <td class="td-number">
                              <div class="btn-group align-content-center mt-2" style="white-space: nowrap;">
                                <button class="btn btn-info btn-sm px-2 restProduct2"> <i class="fas fa-minus text-white"></i> </button>
                                  <p  class="px-2 mt-1 bg-white countProduct2 ">1</p>
                                <button class="btn btn-info btn-sm px-2 addProduct2"> <i class="fas fa-plus text-white"></i> </button>
                              </div>
                          </td>
                      </div>
                      <div class="col-8">
                        <button data-product="" onclick="pedir()"  class=" btn btn-info btn--modal-theme btn-block text-center px-1 text-nowrap nowrap">
                         <i class="lni lni-cart"></i> Agregar a la cesta$<b><small data-ingretotal="" data-total="" id="total">$20.000</small></b>
                         </button>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>3

  </div>
  <script>
    var TotalObli=0
    var comercio={{$restaurant->id}}
    var producto=null;
    var allCategories=[];
    var cacheProduct;
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
   function showProduct(id) {
   fetch('/product/'+id,{method:"get"}).then((response)=>{
    if (!response.ok) {
        return Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Error servidor',
            showConfirmButton: false,
             timer: 1500
         })
    }
        return response.json()

} )
   .then((data)=>{
       TotalObli=0;
       allCategories=[];
       console.log(data);
      let product=data.product[0];
       $('.countProduct').text(1);
       $('#exampleModalScrollableTitle').text(product.name);

       if (product.value.discount==null) {
        $('#totalUnit').val(product.value.value)
        $('#total').attr('data-total',product.value.value);
       $('#total').text(product.value.value );
       }else{
        $('#totalUnit').val(product.value.discount)
        $('#total').attr('data-total',product.value.discount);
       $('#total').text(product.value.discount );
       }

       $('#desP').text(product.description);
       $('#imageModalR').prop('src', $('.product-img').data('route')+product.img_product)
       cacheProduct=product;
    let categoryIngre=data.ingr
       $('#ingredientesAll').empty();
    categoryIngre.forEach((tipoCategoria)=>{
        tipoCategoria.categorias.forEach((categorias)=>{
            if (categorias.get_ingredients.length>0) {
                allCategories.push(categorias)
                switch (tipoCategoria.id) {
               case 6:

                    // adicionales
                let row=`
                <div class="row border-bottom px-2 mt-2">
                          <h2 class="m-0 p-0 col-12"> ${categorias.name}</h2><br>
                          <h6 class="text-muted m-0 p-0"><small>Seleccione Los ingredientes que deseas</small></h6>

                        `
                let subrow=""
                        categorias.get_ingredients.forEach((cate)=>{
                         subrow+=  `<div class="row border-bottom col-12 my-1 pb-3">
                            <div class="col-md-9 col-6 px-0 mx-0 ">
                                <h5 class="text-dark py-0 my-0 mt-2 ml-2">${cate.name} <smalll id="${cate.id}">$${cate.value==null?0:cate.value}</small></h5>
                            </div>
                            <div class="col-md-3 col-3 px-0 mx-0 ">
                                <td class="td-number">
                                    <div class="btn-group align-content-center" style="white-space: nowrap;">
                                      <button class="btn btn-info btn-sm px-2 aditionalsRest" > <i class="fas fa-minus text-white"></i> </button>
                                        <p data-name=${cate.name}  data-category="${categorias.id}"data-toggle="${cate.id}" data-id="${cate.id}" data-value="${cate.value==null?0:cate.value}" data-count="0" class="px-2 mt-1 bg-white inputAdicionals">0</p>
                                        <button class="btn btn-info btn-sm px-2 aditionalsAdd"> <i class="fas fa-plus text-white"></i> </button>
                                    </div>
                                </td>
                            </div>
                        </div>
                       `;


                        })


            $('#ingredientesAll').append(row+subrow+"</div>")
                   break;
                   case 8:
                let row1=`
                <div class="row border-bottom px-2 mt-2">
                          <h2 class="m-0 p-0 col-12"> ${categorias.name}</h2>
                          <h6 class="text-muted m-0 p-0"><small>Escoja los ingredientes que desea</small></h6>

                        `
                let subrow1=""
                        categorias.get_ingredients.forEach((cate)=>{
                         subrow1+=
                    `<div class="row border-bottom col-12 my-1 pb-3">
                            <div class="col-md-9 col-6 px-0 mx-0 ">
                                <h5 class="text-dark py-0 my-0 mt-2 ml-2">${cate.name}  </h5>
                            </div>
                            <div class="col-md-3 col-3 px-0 mx-0 ">
                                <td class="td-number">
                                    <div class="btn-group align-content-center" style="white-space: nowrap;">
                                      <button class="btn btn-info btn-sm px-2 regularesRest" > <i class="fas fa-minus text-white"></i> </button>
                                        <p data-name=${cate.name}  data-category="${categorias.id}" data-id="${cate.id}" data-count="1" class="px-2 mt-1 bg-white inputRegulares">1</p>
                                        <button class="btn btn-info btn-sm px-2 regularesAdd"> <i class="fas fa-plus text-white"></i> </button>
                                    </div>
                                </td>
                            </div>
                        </div>
                       `;


                        })


            $('#ingredientesAll').append(row1+subrow1+"</div>")
                   break;
                case 7:

                maxObi=categorias.max_ingredients;
                if (categorias.get_ingredients.length>0) {
                    TotalObli+=maxObi;
                }
                let row2=  `
                <div class="row border-bottom px-2 mt-2 pl-2" id="${'obli'+categorias.id}" data-count="0" data-max="${maxObi}">
                          <h2 class="m-0 p-0 col-12"> ${categorias.name} </h2>
                          <h6 class="text-muted m-0 p-0"><small>Seleccione   ${categorias.max_ingredients} ingredientes (obligatorio)</small></h6>
                            `
                        let subrow2="";
                        categorias.get_ingredients.forEach((item)=>{
                          subrow2+=
                            `<div  class="row border-bottom col-12 my-2"  >
                                <div class="col-md-10 col-6 px-0 mx-0 ">
                                    <h5 class="text-dark py-0 my-0 mt-2 ml-2">${item.name}</h5>
                                </div>
                                <div class="form-check" data-max>
                                    <label class="form-check-label">
                                        <input data-name=${item.name}  class="form-check-input position-static checkOb"data-category="${categorias.id}" data-id="${item.id}" type="checkbox" data-toggle="${'obli'+categorias.id}" value="${id}" aria-label="...">
                                        <span class="form-check-sign"></span>
                                    <label>
                                </div>
                           </div>`


                        });

                 $('#ingredientesAll').append( row2+subrow2+'</div>')
                  break;

               default:
                break;
           }


            }
        })



    });
     producto=product.id;
     $('#modalRestaurante').modal("show");
   })
}
$('body').on('click','.aditionalsAdd',function (){
    let btn=$(this);
    let input=btn.siblings('p');
    let counter=Number(input.attr('data-count')) +1;
    input.attr('data-count',counter);
    input.text(counter);
    let mySpan=$('#'+input.attr('data-toggle'));
    mySpan.text('$'+(counter*input.attr('data-value')));
    let ingretotal=Number(input.attr('data-value'))
    // Recalculo el total
    let  total=+$('#total').attr('data-total');
    total+=ingretotal

    $('#total').attr('data-ingretotal',ingretotal+Number($('#total').attr('data-ingretotal')));
    $("#total").attr('data-total',total);
    $("#total").text(total);

});
$('body').on('click','.aditionalsRest',function (){
    let btn=$(this);
    let input=btn.siblings('p');
    let counter=Number(input.attr('data-count')) -1;
    if (counter>=0) {
    input.attr('data-count',counter);
    input.text(counter);
    let mySpan=$('#'+input.attr('data-toggle'));
    mySpan.text(counter==0?'$'+input.attr('data-value'):'$'+(counter*input.attr('data-value')));
    let ingretotal=Number(input.attr('data-value'))
    // Recalculo el total
    let  total=+$('#total').attr('data-total');
    total-=ingretotal
    $('#total').attr('data-ingretotal',Number($('#total').attr('data-ingretotal')-ingretotal));
    $("#total").attr('data-total',total);
    $("#total").text(total);
    }
})
$('#modalRestaurante').on('click','.regularesAdd',function (){
    let btn=$(this);
    let input=btn.siblings('p');
    let counter=Number(input.attr('data-count')) +1;
    if (counter==1) {
       input.attr('data-count',counter);
       input.text(counter);
    }


});
$('#modalRestaurante').on('click','.regularesRest',function (){
    let btn=$(this);
    let input=btn.siblings('p');
    console.log(input)
    let counter=Number(input.attr('data-count')) -1;
    if (counter==0) {
    input.attr('data-count',counter);
    input.text(counter);
    }
});
$('#modalRestaurante').on('click','.checkOb',function () {
    let padre=$('#'+$(this).attr('data-toggle'));
    let max=+padre.attr('data-max')
    let count=+padre.attr('data-count')
    count++
    console.log(max,count);


    if (max>=count) {
        if ( $(this).is(':checked')) {
        padre.attr('data-count',count)
        }
    }
   else{
       if (!$(this).is(':checked')) {
        count-=2
        console.log(count);
        padre.attr('data-count',count)
        }else{
        $(this).prop('checked',false)
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Debe selecionar la cantidad establecida',
            showConfirmButton: false,
             timer: 1500
         })

        }
    }




})

function getIngredients() {
    let  dataIngredients=[];
        allCategories.forEach((category)=>{
            catTosend={
                    category_name:category.name,
                    ingredient_category_id: category.id,
                    get_ingredients:[]
                }
                let filtro='[data-count="0"][data-category="'+category.id+'"]';
                let filtrocheck='[data-category="'+category.id+'"]';
            switch (category.category_type_vp) {

                case 6:

                    $('.inputAdicionals').not(filtro).each(function(){
                      catTosend.get_ingredients.push(
                          {
                            ingredient_name: $(this).attr('data-name'),
                            ingredient_id:  $(this).attr('data-id'),
                            ingredient_quantity:$(this).attr('data-count')
                          })
                    });
                    break;
                case 7:
                $('.checkOb:checked'+filtrocheck).each(function(){
                      catTosend.get_ingredients.push(
                          {
                            ingredient_name: $(this).attr('data-name'),
                            ingredient_id:  $(this).attr('data-id'),
                            ingredient_quantity:true
                          })
                    });

                    break;
                case 8:
                $('.inputRegulares').not(filtro).each(function(){
                      catTosend.get_ingredients.push(
                          {
                            ingredient_name: $(this).attr('data-name'),
                            ingredient_id:  $(this).attr('data-id'),
                            ingredient_quantity:$(this).attr('data-count')
                          })
                    });
                    break;
                default:
                    break;
            }

            dataIngredients.push(catTosend);
        })
    return dataIngredients;
}


function productCart(idCommerce,idProduct,qty,aditionals) {
       let data={
             commerce:idCommerce,
             Product:idProduct ,
             qty:qty,
             img:cacheProduct.img_product,
             aditionals:getIngredients()
            }
       fetch('/carrito',
       {
          method:'post',
          headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
            'Content-Type':'application/json'
         },
          body:JSON.stringify(data)
         })
       .then((response)=>{

          if (!response.ok) {
           return  Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: ' Termine compra o vacie carrito para comprar aqui',
            showConfirmButton: false,
             timer: 2000
         })}
             response.json().then((data)=>{
         Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'producto agregado',
            showConfirmButton: false,
             timer: 1500
         })
         $('#cartCounter').text(data['counter'])
            window.location.reload();
          })
       })



    }
function pedir() {
        if (TotalObli==document.querySelectorAll('.checkOb:checked').length) {
        let cantidad= Number($('.countProduct2').text());
        console.log(cantidad);
        if (cantidad>0) {
            productCart(comercio,producto,cantidad,null);
            $('#modalRestaurante').modal("hide");

        }else{
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'La cantidad debe ser mayor a 0',
                showConfirmButton: false,
                timer: 1500
            })
        }
        }else{
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Debes selecionar todos los obligatorios',
                showConfirmButton: false,
                timer: 1500
            })

        }

   }



</script>
@endsection

<!--Modal de platos Restaurantes-->


