<div id="modal-right" class="modal fade" data-backdrop="true">
    <div class="modal-dialog modal-right w-xl-right">
        <div class="modal-content h-100 no-border-radius">
            <div class="modal-header" style="min-height: 10vh;max-height: 10vh;">
                @isAuth
                <div class="modal-title text-md">Entregar en: <br>
                    <a href="#" class="text-dark">

                         <strong style="font-size: 15px" id="localDirection" class="display-4">
                            No ha selecionado ninguna direccion<i class="fas fa-caret-down"></i>
                        </strong>


                    </a>
                </div>
                @endisAuth
                <button data-dismiss="modal" class="btn btn-neutral"><img src="{{ asset('assets/img/brand/close.png')}}" width="40%"></button>
            </div>
            <div class="modal-body bg-light" style="min-height: 75vh; max-height: 15vh !important; overflow-y: auto !important;">

                <div id="modalDetails">

                    @section('detalle')
                        @include('system.layouts.global.components.detalle')
                    @show


                </div>
            </div>
            <div class="modal-footer my-auto bg-white" style="min-height: 15vh; max-height: 15vh;">
               <div class="container fixed-bottom mb-3 bg-white">
                   <div class="row mt-3">
                        <div class="col-4 text-center align-content-center">
                        <a  {{!request()->segment(1)=='checkout'?'href='."/cart/delete":'href='."/cart/delete2"}} type="button" class="btn btn-neutral w-100 btn-lg btn-block p-0 m-0 pt-3"  ><i class="fas fa-trash"></i> Vaciar</a>
                        </div>
                        <div class="col-8 text-center align-content-center">
                            @isAuth
                            @if (count($Cart) > 0)
                            <form  id="loginbtn" method="get">
                                <button type="submit"  class="btn btn-info btn-lg w-100 btn-block text-white nowrap text-nowrap p-0 m-0 pt-3"  >
                                <h4 class="text-nowrap mb- text-white"><strong>Ir a pagar</strong> <small id="totalPayment">${{$total??'0'}}</small> </h4>
                                </button>
                            </form>
                            @else
                            <h1> vacio </h1>
                            @endif
                            @endisAuth
                            @if (empty(Session('active_user')))
                            <form action="{{route('checkout')}}" method="get">
                                <button  type="submit" class="btn btn-info btn-lg w-100 btn-block text-white nowrap text-nowrap p-0 m-0 pt-3"  >
                                    <h4 class="text-nowrap mb- text-white"><strong>Iniciar Sesión</strong>  </h4>
                                </button>

                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  var minimoCompra={{session('minimoCompra.value')??0}}
    if (localStorage.dir==null) {
        $('#localDirection').text("No se ha selecionado ninguna direccion")
    }else{
        $('#localDirection').text(JSON.parse(localStorage.dir).dir)
         $('#navBarDir').text(JSON.parse(localStorage.dir).dir)
    }
$('#loginbtn').on('submit',function (e){
    e.preventDefault();
    let total=$('#totalPayment').text().replace(/\.00|\$|,/g,'')
        total=Number(total)
        console.log(total)
    if (total<minimoCompra) {

        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Debe Agregar mas productos al carrito su minimo de compra es:'+minimoCompra,
            showConfirmButton: false,
             timer: 3000
         })
    }else{
        window.location="/checkout"
    }
})

 function addToCart(rowId,operation) {

    console.log(operation);
    data={ rowId:rowId, operation:operation}
    fetch('/carrito/0',{
         method:'put',
         headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
            'Content-Type':'application/json'
        },
        body:JSON.stringify(data)
    }).then((response) => {
        if (response.ok) {

            return response.json();
        }else{
            alert(response.json());
            $
            alert("Oops!. Hemos tenido problemas, intenta nuevamente");
        }

    }).then((data)=>{
        getCountCart();
        $('#modalDetails').html(data['view']);
        $('#totalPayment').text('$'+data.total);

     })
 }



</script>
