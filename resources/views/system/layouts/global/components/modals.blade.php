<!--Modal de productos Comercios-->

<style>
    .pac-container {
        z-index: 10000 !important;
    }
 </style>

 <div class="modal fade" id="idAddAddressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header justify-content-center">
           <div class="modal-title text-md text-info">Agregar dirección:
           </div>
           <button data-dismiss="modal" class="btn btn-neutral"><img src="{{ asset('assets/img/brand/close.png')}}" width="40%"></button>
         </div>
         <div class="modal-body">
           <form method="POST" id="formAddAddressModal">
             <div class="form-group has-feedback">
               <div class="input-group mb-0">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fa fa-map-marker-alt text-info"></i></span>
                 </div>
                 <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Mi casa | mi oficina" required autofocus>
               </div>
               <span><small class="text-validate text-danger" id="validate-name"></small></span>
             </div>
             <div class="form-group has-feedback">
               <div class="input-group mb-0">
                 <input type="hidden" name="lat" id="idAddAddressLat">
                 <input type="hidden" name="lng" id="idAddAddressLng">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fa fa-map-marker-alt text-info"></i></span>
                 </div>
                 <input type="text" class="form-control" id="idAddAddressInput" autocomplete="off" placeholder="Calle 54#24-55. Bogotá, Colombia" name="address" required autofocus>
               </div>
               <span><small class="text-validate text-danger" id="validate-address"></small></span>
             </div>
             <div class="form-group has-feedback">
               <div class="input-group mb-0">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fa fa-user text-info"></i></span>
                 </div>
                 <input type="text" class="form-control" placeholder="Apartamento 3, Piso 2" name="observation" required autofocus>
               </div>
               <span><small class="text-validate text-danger" id="validate-observation"></small></span>
             </div>
           </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
           <button type="button" onclick="addAddressModal()" class="btn btn-info">Agregar</button>
         </div>
       </div>
     </div>
   </div>

   <!-- Modal editar direcciones -->
   <div class="modal fade" id="idEditAddressModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header justify-content-center">
           <div class="modal-title text-md text-info">Editar dirección:
           </div>
           <button data-dismiss="modal" class="btn btn-neutral"><img src="{{ asset('assets/img/brand/close.png')}}" width="40%"></button>
         </div>
         <div class="modal-body">
           <form method="POST" id="formEditAddressModal">
             <div class="form-group has-feedback">
               <div class="input-group mb-0">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fa fa-map-marker-alt text-info"></i></span>
                 </div>
                 <input type="text" class="form-control" autocomplete="off" name="name" id="idEditAddressName" placeholder="Mi casa | Mi oficina" required autofocus>
               </div>
               <span><small class="text-validate text-danger" id="validate-name"></small></span>
             </div>
             <div class="form-group has-feedback">
               <div class="input-group mb-0">
                 <input type="hidden" name="lat" id="idEditAddressLat">
                 <input type="hidden" name="lng" id="idEditAddressLng">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fa fa-map-marker-alt text-info"></i></span>
                 </div>
                 <input type="text" class="form-control" id="idEditAddressInput" autocomplete="off" placeholder="Calle 54#23-54. Bogotá, Colombia." name="address" required autofocus>
               </div>
               <span><small class="text-validate text-danger" id="validate-address"></small></span>
             </div>
             <div class="form-group has-feedback">
               <div class="input-group mb-0">
                 <div class="input-group-prepend">
                   <span class="input-group-text"><i class="fa fa-user text-info"></i></span>
                 </div>
                 <input type="text" class="form-control" id="idEditAddressObservation" placeholder="Apartamento 2, Piso 3" name="observation" required autofocus>
               </div>
               <span><small class="text-validate text-danger" id="validate-observation"></small></span>
             </div>
           </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-danger">Cerrar</button>
           <button type="button" onclick="updateAddressModal()" class="btn btn-info">Editar</button>
         </div>
       </div>
     </div>
   </div>


   <!--Boton de Whatsapp Flotante-->
   <a href="https://api.whatsapp.com/send?phone=573108777339&amp;text=Hola,%20deseo%20realizar%20un%20nuevo%20pedido%20" class="btn_whatsapp" target="_blank" >
     <i class="fab fa-whatsapp fa-3x mt-1 mb-1" aria-hidden="true"></i>
   </a>
   <!--Boton de carrito Flotante-->
   @if(Route::current()->getName() != 'login')
   <div class="btn-cart-pay d-block d-sm-block d-md-block d-lg-none d-xl-none">
       <div class="row">
             <button data-toggle="modal" data-target="#modal-right" data-toggle-class="modal-open-aside" class="btn btn-info btn-icon btn-lg shadow-lg" type="button">
               <i class="fas fa-shopping-cart fa-4x"></i>
             </button>
           </div>
       </div>
   </div>
   @endif


 <!--Modal Cupones-->
 <div class="modal fade modal-mini modal-mini show" id="modalCupones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header justify-content-center">
          <button data-dismiss="modal" class="btn btn-neutral">
           <img src="{{ asset('assets/img/brand/close.png')}}" width="30%">
         </button>
         <div class="modal-profile shadow-sm border">
           <img src="{{ asset('assets/img/brand/coupon.png')}}" class="no-border-radius" style="padding-bottom: 9px;">
         </div>
       </div>
       <div class="modal-body">
         <div class="row">
             <div class="col-12 mt-1">
                 <div class="form-group">
                     <input type="text" value="" placeholder="Ingresa un cupón" class="form-control"/>
                 </div>
             </div>
         </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Cerrar</button>
         <button type="button" class="btn btn-info" data-dismiss="modal"><strong>Validar</strong></button>
       </div>
     </div>
   </div>
 </div>

 <!--Modal Direcciones-->
 @isAuth
 <div class="modal fade show" id="modalSelectDireccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
   <div class="modal-dialog">
     <div class="modal-content p-4">
       <div class="modal-header justify-content-center">
          <button data-dismiss="modal" class="btn btn-neutral">
           <img src="{{ asset('assets/img/brand/close.png')}}" width="30%">
         </button>
         <div class="modal-profile shadow-sm border">
           <i class="fas fa-map-marker-alt"></i>
         </div>
       </div>
       <div class="modal-body">
         <div class="row">
             <div class="col-12 mt-1">
                 <div class="form-group">

                     <select id="DirS" class="form-control" required="">
                       <option value="0" disabled="" selected="">Selecciona una dirección</option>
                        @foreach ($ListD as $item)

                     <option data-lat="{{$item['lat']}}" data-lng="{{$item['lng']}}" data-addressName="{{$item['name']}}" data-addressDetalle="{{$item['observation']}}" value="{{$item['id']}}">{{$item['address']}}</option>

                         @endforeach

                   </select>
               </div>
             </div>
         </div>
       </div>
       <div class="modal-footer mt-3">
         <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#idAddAddressModal">
          <strong><i class="fas fa-plus"></i> Nueva</strong>
         </button>
         <button type="button" class="btn btn-info" onclick="selectD()"  ><strong>Guardar</strong></button>
       </div>
     </div>
   </div>
 </div>
 @endisAuth

  <a href="{{asset('assets/CATALOGO-JUGUETES-FAVORES.pdf')}}" style="bottom: 100px;" class="btn_whatsapp" target="_blank" >
    <img src="{{asset('assets/img/toy-train.png')}}" width="35px" heigth="35px">
  </a>


 <!--Boton de Whatsapp Flotante-->
 <a href="https://api.whatsapp.com/send?phone=5717946011&amp;text=Hola,%20deseo%20realizar%20un%20nuevo%20pedido%20" class="btn_whatsapp" target="_blank" >
  <i class="fab fa-whatsapp fa-3x mt-1 mb-1" aria-hidden="true"></i>
 </a>
 <!--Boton de carrito Flotante-->
 @if(Route::current()->getName() != 'login')
 <div class="btn-cart-pay d-block d-sm-block d-md-block d-lg-none d-xl-none">
    <div class="row">
          <button data-toggle="modal" data-target="#modal-right" data-toggle-class="modal-open-aside" class="btn btn-info btn-icon btn-lg shadow-lg" type="button">
            <i class="fas fa-shopping-cart fa-4x"></i>
          </button>
        </div>
    </div>
 </div>
 @endif
 <script>
     function selectD(){
        let id=$('#DirS').val();
        let  data={
             id:id,
             dir:$('#DirS option:selected').text(),
             name:$('#DirS option:selected').attr('data-addressName'),
             detalle:$('#DirS option:selected').attr('data-addressDetalle'),
             lat:$('#DirS option:selected').attr('data-lat'),
             lng:$('#DirS option:selected').attr('data-lng')
         }
         if (id!=null) {
             Swal.fire({
             position: 'top-end',
             icon: 'success',
             title: 'Direccion selecionada',
             showConfirmButton: false,
              timer: 1500
          }).then(() =>{
             fetch('/addDir',
          {
          method:'post',
          headers:{
             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
            'Content-Type':'application/json'
         },
          body:JSON.stringify(data)
         }).then((response)=>{
           if (!response.ok) {
              Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: 'servidor',
              showConfirmButton: false,
              timer: 1500
          });
           }else{
              localStorage.dir=JSON.stringify( data);
              $('#localDirection').text(JSON.parse(localStorage.dir).dir)
              let address=JSON.parse(localStorage.dir);
              $('#detalleAddress').text(address.detalle)
              $('#checkoutDirection').text(address.dir)
              $('#nameAddress').text(address.name);
               $('#navBarDir').text(JSON.parse(localStorage.dir).dir)
              $('#modalSelectDireccion').modal("hide");
              window.location.reload()
           }

         })
          });

         }else{
             Swal.fire({
             position: 'top-end',
             icon: 'error',
             title: 'Direccion vacia',
             showConfirmButton: false,
              timer: 1500
          });
         }

     }

    $('.addProduct').click(()=>{
        let counted=Number($('.countProduct').text());
        counted++
        console.log(counted);
        let total=$('#total').attr('data-uprice')
        $("#total").text('$'+(Number(counted)*Number(total)).toLocaleString('en'))
        $('.countProduct').text(counted);
    });
    $('.restProduct').click(()=>{
        let counted=Number($('.countProduct').text());
        if (counted>=2) {
            counted--
            let total=$('#total').attr('data-uprice')
            $("#total").text('$'+(Number(counted)*Number(total)).toLocaleString('en'))
            $('.countProduct').text(counted);
        }

    });
    // restaurante
    $('.addProduct2').click(()=>{
        let counted=Number($('.countProduct2').text());
        counted++
        console.log(counted);
        $('.countProduct2').text(counted);
        let total=Number($('#total').attr('data-ingretotal'))+Number($('#totalUnit').val())
        $("#total").text(Number(counted)*Number(total))
        $("#total").attr('data-total',Number(counted)*Number(total));
    });
    $('.restProduct2').click(()=>{
        let counted=Number($('.countProduct2').text());
        if (counted>=2) {
            let counted=Number($('.countProduct2').text());
        counted--
        console.log(counted);
        $('.countProduct2').text(counted);
        let total=(Number($('#total').attr('data-ingretotal'))+Number($('#totalUnit').val()))
        $("#total").text(Number(counted)*Number(total))
        $("#total").attr('data-total',Number(counted)*Number(total));
        }

    });
    function addAddressModal() {
       $("#formAddAddressModal #text-validate").html("");

       var formData = new FormData(document.getElementById("formAddAddressModal"));

       var urlPath = urlHost + "/perfil/address/add";
       $.ajax({
         type: 'POST',
         url: urlPath,
         data: formData,
         dataType: 'json',
         processData: false,
         contentType: false,
         cache: false,
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         beforeSend:function(){},
         success:function(response){
           if (response.state == 1) {
               dataDir={
                   id:response.data.id,
                   dir:response.data.address,
                   name:response.data.name,
                   detalle:response.data.observation
               }
             $("#idAddAddressModal").modal('hide');
             $("#formAddAddressModal")[0].reset();
             $("#idListAddress").load(location.href + " #idListAddress>*","");
              localStorage.dir=JSON.stringify( dataDir);
             $('#localDirection').text(JSON.parse(localStorage.dir).dir)
             let address=JSON.parse(localStorage.dir);
             $('#detalleAddress').text(address.detalle)
             $('#checkoutDirection').text(address.dir)
             $('#nameAdress').text(address.name)
              window.location.reload();

           }else if (response.state == 2) {
             alert("Oops!. "+response.message);
           }else{
             alert("Oops!. Hemos tenido problemas, intenta nuevamente");
           }
         },
         error: function(xhr){
           if (xhr.responseJSON.errors) {
             $.each(xhr.responseJSON.errors, function( index, value ){
               $("#formAddAddressModal #validate-"+index).html(value[0]);
             });

             alert("Oops!. Debe enviar los datos correctamente");
           }else{
             alert("Oops!. Hemos tenido problemas, intenta nuevamente");
           }
         }
       });
     }


 </script>
 <script type="text/javascript">
     function initMap() {
       console.log("initMap");
       var defaultBounds = new google.maps.LatLngBounds(
         new google.maps.LatLng(4.511299, -74.170789),
         new google.maps.LatLng(4.769863, -74.024819)
       );

       autocompleteAddress = new google.maps.places.Autocomplete(
         document.getElementById('idAddAddressInput'), {
           bounds: defaultBounds,
           fields: ['geometry'],
         }
       );
       autocompleteAddress.addListener('place_changed', function() {
         let place = autocompleteAddress.getPlace()
         $('#idAddAddressLat').val(place.geometry.location.lat)
         $('#idAddAddressLng').val(place.geometry.location.lng)
         console.log("Place Changed");
       });

       autocompleteAddressEdit = new google.maps.places.Autocomplete(
         document.getElementById('idEditAddressInput'), {
           bounds: defaultBounds,
           fields: ['geometry'],
         }
       );
       autocompleteAddressEdit.addListener('place_changed', function() {
         let place = autocompleteAddressEdit.getPlace()
         $('#idEditAddressLat').val(place.geometry.location.lat)
         $('#idEditAddressLng').val(place.geometry.location.lng)
       });
     }
     function cerrado() {
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: 'Vuelve mañana el comercio esta cerrado',
            showConfirmButton: false,
             timer: 1500
         })
     }
   </script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA01EIKVqGmy9BAhcDyT-nsJsLtBUbU_gA&libraries=places&callback=initMap"></script>
