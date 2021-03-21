<div class="modal bd-example-modal-lg"  id="modalSuperMarket" tabindex="-1" role="dialog" aria-hidden="true">
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
             <img  data-route="{{config('app.url_apiRequest')}}storage/" alt="..." class="align-self-center mr-3 product-img" style="min-width: 20vh; max-height: 45vh;">
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
                         <div class="display-5 font-weight-bold text-danger mt-1  "> <span class="product-price"></span> <s  id="product-price-discounted" class="text-info"></s> <span id="product-price-discount"></span> </div>

                      </div>
                      <div class="col-6">
                         <div class="btn-group align-content-center" style="white-space: nowrap;">
                             <button class="btn btn-info btn-sm px-2 restProduct"> <i class="fas fa-minus text-white"></i> </button>
                               <p class="px-2 mt-1 bg-white countProduct">1</p>
                             <button class="btn btn-info btn-sm px-2 addProduct"> <i class="fas fa-plus text-white"></i> </button>
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
            <button data-product="" id="addProduct" class=" btn btn-info btn--modal-theme text-center"> <i class="lni lni-cart"></i> Agregar a la cesta </button>
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
    </div>

  </div>
@section('js')

  <script>
    var TotalObli=0
    var comercio;
    var producto=null;
    var allCategories=[];
    var cacheProduct;
    var minimo=null
    $('.owl-products').owlCarousel({
      loop: false,
      rewind: true,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 4000,
      autoplayHoverPause: true,
      responsiveClass: true,
      responsive: {
         0: {
            items: 2,
            nav: true
         },
         600: {
            items: 4,
            nav: false
         },
         1100: {
            items: 6,
            nav: false
         }
      }
   })

    //muestra el modal de super mercado
    function showProductSuperMarket(id) {
        comercio=+$('#btn-add-to-cart').attr('data-commerce');

        fetch('/product/'+id,{method:"get"}).then(response=>response.json())
        .then((data)=>{
           console.log(data)
            let product =data.data
            cacheProducto=data.data;
            $('#product-price-discount').text("");
            $('#product-price-discounted').text("");
            $('.product-price').text("");
            $('.countProduct').text(product.value.min)
            $('#variaciones').empty();
            $('.product-title').text(product.name)
            $('#quantityContent').text(product.get_market_product.quantity_content==null?product.get_market_product.quantity_content: '1'+' '+product.getUnit.name)
            $('.product-des').text(product.description)
            if (product.value.discount!=null) {
                $('#product-price-discount').text('$'+product.value.discount.toLocaleString('en'))
                $('#product-price-discounted').text('$'+product.value.value.toLocaleString('en'))
            }else{
                $('.product-price').text('$'+product.value.value.toLocaleString('en'))
            }

            $('.product-img').prop('src',$('.product-img').data('route')+product.img_product)
            $('#minimoProductC').text(product.value.min)
            producto=product.id;
            minimo=product.value.min;
            let variaciones=product.get_market_product.get_product_variations;
            if (variaciones.length==0) {
                $('.title-variaciones').text('')
            }else{
                $('.title-variaciones').text('Variaciones')
            }
            variaciones.forEach((item,index)=>{

                let rowVariaciones=`
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
    function productCartS(idCommerce,idProduct,qty,aditionals) {
       console.log(idCommerce,idProduct,aditionals)
       let data={
             commerce:idCommerce,
             Product:idProduct ,
             qty:qty,
             aditionals:aditionals,
             img:cacheProducto.img_product
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
            title: 'Termine compra o vacie carrito para comprar aqui',
            showConfirmButton: false,
             timer: 2500
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
            window.location.reload()
          })
       })

    }
    $('#addProduct').click(()=>{
        let cantidad= Number($('.countProduct').text());
        if (cantidad>=minimo) {
            let  adicionales=$('#adicionalsProduct').val();
            console.log(comercio,producto,cantidad)
            productCartS(comercio,producto,cantidad,adicionales);
            $('.bd-example-modal-lg').modal("hide");
        }else{
            Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Debes escoger minimo '+minimo+'productos',
            showConfirmButton: false,
             timer: 1500
         })
        }

    })
    $('body').on('change','.checkVariaciones',function(){
        if ($(this).prop('checked')) {
         $('.checkVariaciones').each(function(){
            $(this).prop('checked',false)
        });
        $(this).prop('checked',true);
        let index=Number($(this).attr('data-index'));
        let product=cacheProducto.get_market_product.get_product_variations[index];
        $('.product-price').text('$'+product.value.value)
        $('.product-title').text(product.get_product.name)
            if (product.value.discount!=null) {
                $('.product-price').text('');
                $('#product-price-discounted').text('$'+product.value.value)
                $('#product-price-discount').text('$'+product.value.discount)
            }else{
                $('#product-price-discounted').text('')
                $('#product-price-discount').text('')
                $('.product-price').text('$'+product.value.value);
            }
        minimo=product.value.min;
        producto=product.product_id;
        $('#minimoProductC').text(product.value.min);
        }else{
        let product=cacheProducto;
        $('.product-title').text(product.name)
        minimo=product.value.min;
        producto=product.id;
        if (product.value.discount!=null) {
                $('.product-price').text('');
                $('#product-price-discounted').text('$'+product.value.value)
                $('#product-price-discount').text('$'+product.value.discount)
            }else{
                $('#product-price-discounted').text('')
                $('#product-price-discount').text('')
                $('.product-price').text('$'+product.value.value);
            }
        $('#minimoProductC').text(product.value.min);

        }

    })


   function showProductRestaurant(id) {
    comercio=+$('#btn-add-to-cart').attr('data-commerce');
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

function productCartR(idCommerce,idProduct,qty,aditionals) {
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
            productCartR(comercio,producto,cantidad,null);
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

