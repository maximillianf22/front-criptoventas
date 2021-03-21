@extends('system.layouts.global.index')
@section('title', 'Checkout')

@section('css')
<link href="{{ asset('assets/css/styles.css')}}" rel="stylesheet" />
<style>
    .propinaValue::before {
        content: '$'
    }
</style>
@endsection

@section('content')
<!-- Header -->
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h2 class="title"></h2>
                <div class="container-fluid bg-white mt-5" id="container_expands">
                    <div class="container">
                        <h4 class="mb-0 ml-2 pt-3">
                            <strong> Nombre:</strong><span id="nameAddress"> </span>
                        </h4>
                        <h4 id="checkoutDirection" class="pt-1 ml-2 mb-0"><b>Dirección:</b> </h4>
                        <h3 class="ml-2 mb-0">
                            <strong> Detalle:</strong><span id="detalleAddress"></span>
                        </h3>
                        <button class="btn btn-info mb-3 btn-sm" data-toggle="modal"
                            data-target="#modalSelectDireccion"><i class="fas fa-map-marker-alt"></i> Seleccionar
                            otra</button>
                        <h4 class="pt-3 ml-2 mb-0"><b>Fecha de Entrega:</b> <span id="stringFecha"></span> </h4><br>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input class="form-control datepicker">
                                </div>
                            </div>
                            <div class="col-6">
                                <select class="form-control" id="horarioSelect" data-size="7"
                                    data-style="btn btn-info btn-simple" title="Horarios">
                                    <option disabled selected>Horarios disponibles</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid bg-white mt-4" id="container_expands">
                    <div class="container-fluid bg-white" id="container_expands">
                        <div class="container pb-2 pt-2">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="pt-4 ml-2 mb-0"><b>Metodo de pago:</b></h4>
                                </div>
                                <div class="col-6">
                                    <select class="selectpicker ml-3 mt-3" id="payment"
                                        data-style="btn btn-info btn-simple" title="Seleccione metodo de pago">
                                        @foreach ($payment_type_vp as $item)
                                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: .5em">
                                <div class="col-6">
                                    <h4 class="pt-4 ml-2 mb-0"><b>Comentarios y observaciones:</b></h4>
                                </div>

                                <div class="col-6">
                                    <textarea name="" value="" cols="25" rows="3"
                                        style="font-size: .78rem; margin-left: 1.3em; width: 100%; border: 1px #ccc solid; border-radius: 1em; outline: none; padding: .5em;"
                                        id="observationsInput"></textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="width:100%;">
                    <div class="container">
                        <div class="container pb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="float-left pt-3"><b>Tus productos</b></h4>
                                </div>
                            </div>
                            <div class="bg-light p-3
                             pt-0 mb-3" style="max-height: 250px !important; overflow-y: auto !important;">
                                @foreach ($cart as $item)
                                <div class="row border-bottom">
                                    <div class="col-md-2 col-3 my-auto">
                                        <div class="avatar text-center" style="height: 50px !important;">
                                            <img class="media-object img-raised" src="{{$item->options['img']}}"
                                                alt="..." style="height: 90% !important;">
                                        </div>
                                    </div>
                                    <div class="col mx-0 my-auto">
                                        <h6 class="text-dark py-0 my-0 mt-2">{{$item->name}} </h6>
                                        <h6 class="text-right"><span class="text-lowercase">x</span> {{$item->qty}} -
                                            ${{number_format($item->price)}}</h6>
                                        <p class="text-muted py-0 my-0 text-responsive" style="line-height: 1.1;">
                                            {{$item->options['des']}} <br>

                                        </p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4 mt-5 mb-4" style="padding-top:15px">
                <div class="container mb-4">
                    <div class="container-fluid bg-white mt-4" id="container_expands">
                        <br>
                        <h5><b>Datos del Pago</b></h5>
                        <div class="row">
                            <div class="col-8">
                                <h5>Costo de productos</h5>
                                <h5>Propina</h5>
                            </div>
                            <div class="col-4 ">
                                <h5>{{$total}}</h5>
                                <h5 style="" class="propinaValue">-</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 ">
                                <h5><strong>&ensp;Domicilio</strong></h5>
                            </div>
                            <div class="col-4  pr-3 ">
                                <h5><strong></strong>{{$deliveryValue}}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8 ">
                                <h5><strong>&ensp;Cupon:</strong></h5>
                            </div>
                            <div class="col-4  pr-3 ">
                                <h5 id="valueCupon"><strong></strong></h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group no-border form-inline mr-5">

                                <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="number"
                                    min="0" name="valueintput" pattern="[0-9]+"
                                    class="form-control ml-3 mt-3 bg-light text-dark   mr-5 valueintput"
                                    placeholder="Escriba propina">
                                <select class="selectpicker ml-3 mt-3 " id="tip_value"
                                    data-style="btn btn-info btn-simple" title="seleccione  propina">
                                    @foreach ($propina as $item)
                                    <option value="{{$item['id']}}">{{$item['value']}}%</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-1">
                                <div class="form-group float-left">
                                    <input type="text" id="inputCupon" style="background-color: ghostwhite !important"
                                        value="" placeholder="Ingresa un cupón" class="form-control" />
                                </div>
                                <button class="btn btn-info btn-sm float-right" id="btn-valid"
                                    type="button">Validar</button>
                            </div>
                        </div>

                        @if (!empty(session('active_user.dist')))

                        <div class="row">
                            <div class="col-8 ">
                                <h5><strong>&ensp;Codigo Distribuidor</strong></h5>
                            </div>
                            <div class="col-4  pr-3 ">
                                <h5 id="distributor_code_text">{{session('active_user.dist.distributor_code')}}</h5>
                            </div>
                        </div>

                        @endif
                        <div class="row">
                            <div class="col-12 mt-1">
                                <div class="form-group float-left">
                                    <input type="text" id="inputDistributor"
                                        style="background-color: ghostwhite !important" value=""
                                        placeholder="Ingresa un distribuidor" class="form-control" />
                                    <input type="hidden" name="idDistributor" value="" id="idDistributor">
                                </div>
                                <button class="btn btn-info btn-sm float-right" id="btn-validDistributor"
                                    type="button" disabled="">Validar</button>
                            </div>
                        </div>



                        <hr style="width:100%;">
                        <div class="row">
                            <div class="col-8 ">
                                <h5><strong>&ensp;Total</strong></h5>
                            </div>
                            <div class="col-4  pr-3 ">
                                <h5><strong data-totalOrder="${{$total2}}"
                                        id="totalOrder">${{number_format($total2)}}</strong></h5>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-2"></div>
                            <div class="col-8">
                                @include('system.templates.payment.payUform')
                                <button class="btn btn-info btn-lg float-center mb-4 btn-block p-3 m-0 checkout"
                                    type="button" style="">
                                    <strong>Hacer pedido</strong>
                                </button>
                            </div>
                            <div class="col-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection
@section('datapicker')
<script>
    var fecha;
    var commerceType={{session('commerce.commerce_type_vp')}}
    var shippingDate;
    var commerce={{session('commerce.id')}}
    var swCupon=false;
    var swDistributor = false;
    var apiKey=null;
    var idDateSelected = null;
    var datesObjects = [];

    fecha=commerceType==10?
    moment().add(1,'days'). millisecond(0).second(0).minute(0).hour(0):
    moment().millisecond(0).second(0).minute(0).hour(0)

    $('.datepicker').datetimepicker({
        locale:"es",
        format:'DD MMM YYYY',
        minDate:fecha,


    })
    if ($('.datepicker').val().length>0) {
        let numberDate=$('.datepicker').data("DateTimePicker").date()._d.getDay();

    if (numberDate!=undefined) {
        data={
            weekDate:numberDate
        }
        fetch('/getHours',
        { headers:{ 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),'Content-Type':'application/json'},
          body:JSON.stringify(data),
          method:"post"
        }).then(response=>response.json())
          .then((data)=>{
              console.log(data);
              datesObjects = data;
              //console.log(datesObjects);
            $('#horarioSelect').empty();
            let firstOption='<option value="0" >Horarios disponibles</option>';
            $('#horarioSelect').append(firstOption);
            data.forEach((item)=>{
                if(item.limit != 0){
                    let option=`<option value="${item.id}">${item.init_hour} - ${item.fin_hour}</option>`;
                    $('#horarioSelect').append(option);
                }
            })

            console.log(shippingDate)
          })
    }
    }
function validateCupon(cupon) {
    data={
        name:cupon,
        commerce_id:commerce
    };
    fetch('/coupons',
    {method:'post',
    headers:{
        'Accept':'application/json',
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
        'Content-Type':'application/json'},
    body:JSON.stringify(data)})

    .then((response)=>{
        if (!response.ok) {
          Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Cupon invalido',
                        showConfirmButton: false,
                        timer: 1500
                        });
            swCupon= false
        }
         response.json().then((data)=>{
            console.log(data);
            data=data.data;
        let oldTotal=Number($('#totalOrder').attr('data-totalOrder').replace(/\$|\.00|,/g,''))
        if (data.min_shopping<=oldTotal) {
            $('#inputCupon').prop('disabled',true);
            $('#valueCupon').text('$'+data.value.toLocaleString('en'));
            let newTotal=oldTotal-data.value;
            let propina=0
            if(typeof  Number($('.valueintput').val())=='number') {
                propina=Number($('.valueintput').val());
            }
            $('#totalOrder').attr('data-totalOrder','$'+newTotal.toLocaleString('en'));
            newTotal+=propina;
            $('#totalOrder').text('$'+newTotal.toLocaleString('en'));
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cupon agregado',
            showConfirmButton: false,
             timer: 1500
            });
            swCupon= true;
            $('#btn-valid').prop('disabled',true);
        }else{
            Swal.fire({
                        position: 'top-end',
                        icon: 'info',
                        title: 'Cupon valido para compras superiores a $'+data.min_shopping.toLocaleString('en'),
                        showConfirmButton: false,
                        timer: 2000
                        });
                        swCupon= false;
        }


        })

        })

}
function validateDistribuitor(distributor_code){

    distributor_code = distributor_code.toUpperCase();
    data = {
        distributor_code: distributor_code
    }
    fetch('/distributor',
    {method:'post',
    headers:{
        'Accept':'application/json',
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
        'Content-Type':'application/json'},
    body:JSON.stringify(data)})
    .then((response)=>{
       
        if (!response.ok) {
          Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Distribuidor inválido',
                        showConfirmButton: false,
                        timer: 1500
                        });
            swDistributor= false
        }
         response.json().then((data)=>{
            //console.log(data)
            if(data.code != 200){
                Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Distribuidor inválido',
                        showConfirmButton: false,
                        timer: 1500
                        });
            swDistributor= false
            }else{

            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Distribuidor válido!',
            showConfirmButton: false,
             timer: 1500
            });
            swDistributor= true;
            $('#btn-validDistributor').prop('disabled',true);
            $('#inputDistributor').prop('disabled',true);
            $('#idDistributor').val(data.data.id);
            $('#distributor_code_text').text(data.data.distributor_code)
            }
        })

        })



}

$('#btn-valid').click( function(){
    if ($('#inputCupon').val().length>0) {
      validateCupon($('#inputCupon').val());

    }
})

$('#btn-validDistributor').click(function(){
    if ($('#inputDistributor').val().length>0) {
      validateDistribuitor($('#inputDistributor').val());
    }
})
$('#inputDistributor').change(function(){
    if($('#inputDistributor').val() != ""){
        $('#btn-validDistributor').prop('disabled', false);
    }else{
        $('#btn-validDistributor').prop('disabled', true);
    }
})


if (localStorage.dir==null) {
        $('#checkoutDirection').text("No se ha selecionado ninguna direccion")
    }else{
        let address=JSON.parse(localStorage.dir);
        $('#detalleAddress').text(address.detalle)
        $('#checkoutDirection').text(address.dir)
        $('#nameAddress').text(address.name)
    }
    $('.checkout').click(function (){

         let paymentMethod=  $('#payment').val()
        if (paymentMethod!="") {
            if (localStorage.dir!=null) {
                if (shippingDate!=null && shippingDate!= undefined) {
                    let objectDateSelected = datesObjects.filter(date => date.id == idDateSelected);
                    if(objectDateSelected[0].limit != 0){
                let data={
                payment_type_vp:Number( $('#payment').val()),
                user_address_id:JSON.parse(localStorage.dir).id,
                tips:$('.valueintput').val(),
                shipping_date:shippingDate,
                objectDateSelected:objectDateSelected[0]
                }
                if (swCupon==true) {
                    data['name']= $('#inputCupon').val()
                }
                if (swDistributor == true){
                    data['distributor_id'] = $('#idDistributor').val()
                }
                if($('#observationsInput').val() != "" || $('#observationsInput').val() !=  null){
                    data['observation'] = $('#observationsInput').val()
                    console.log($('#observationsInput').val())
                    
                }

             fetch('/pagar',{
                method:'post',
                headers:{
                     'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
                     'Content-Type':'application/json'
                },
                body:JSON.stringify(data)
             })
             .then((response)=>{
                if (!response.ok) {
                   return Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'error servidor',
                        showConfirmButton: false,
                        timer: 1500
                        });
                }
               return  response.json()
             }).then((data)=>{
                 let typePay=Number ($('#payment').val())
                    if (typePay==5) {
                        console.log(data)
                        let addressObject=JSON.parse(localStorage.dir);
                        $('[name="referenceCode"]').val(data.data.reference)
                        $('[name="amount"]').val(data.data.total)
                        $('[name="signature"]').val(data.data.signature)
                        $('[name="shippingAddress"]').val(addressObject.dir.detalle)
                        $('[name="description"]').val("Pago realizado en la tienda criptoventas.com con referencia:" + data.data.reference)
                        $('[name="extra1"]').val(data.data.id)
                        $('[name="responseUrl"]').val($('[name="responseUrl"]').val()+data.data.id)
                        $('[name="shippingCity"]').val(addressObject.dir.split(',')[1])
                        $('[name="shippingCountry"]').val(addressObject.dir.split(',')[2])
                        $('#payForm').submit();
                    }else{

              Swal.fire({
                     position: 'top-end',
                     icon: 'success',
                     title: data.message,
                     confirmButtonColor: 'primary',
                     showConfirmButton: true,

            }).then((result)=>{
                if (result.value) {
                    window.location='/'
                }
            })
                    }
             })
                }else{
                     Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'La fecha de entrega seleccionada no tiene cupos, seleccione otra.',
            showConfirmButton: false,
             timer: 1500
            });     
                }
                }else{
                    Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Debe seleccionar una fecha de entrega',
            showConfirmButton: false,
             timer: 1500
            });
                }


            }else{
                Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Debe seleccionar direccion',
            showConfirmButton: false,
             timer: 1500
            });
            }

            }else{
            Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Debe seleccionar metodo de pago',
            showConfirmButton: false,
             timer: 1500
            });
            }

    })
    $('#tip_value').change( ()=>{

let valor= +$('#tip_value :selected').text().replace( '%','');
let total=Number($('#totalOrder').attr('data-totalOrder').replace(/\$|\.00|,/g,''));
$('.valueintput').val(total*valor/100)
let valor2 =Number($('.valueintput').val()).toLocaleString('en');
$('.propinaValue').text(valor2);

let oldTotal=Number($('#totalOrder').attr('data-totalOrder').replace(/\$|\.00|,/g,''))
let newTotal=Number($('.valueintput').val())+oldTotal
    $('#totalOrder').text('$'+newTotal.toLocaleString('en')+'.00')

})
$('.valueintput').change(()=>{
    let valor =Number($('.valueintput').val()).toLocaleString('en');
    $('.propinaValue').text(valor);
    let oldTotal=Number($('#totalOrder').attr('data-totalOrder').replace(/\$|\.00|,/g,''))
    let newTotal=Number($('.valueintput').val())+oldTotal
    $('#totalOrder').text('$'+newTotal.toLocaleString('en')+'.00')

});

$('#horarioSelect').change(()=>{
    if ($('#horarioSelect').val()!=0) {
        shippingDate=$('.datepicker').val()+'|'+$('#horarioSelect :selected').text();
    console.log(shippingDate);
    idDateSelected = ($('#horarioSelect :selected').val())
    //console.log(idDateSelected)
    $('#stringFecha').text(shippingDate)
    

    }else{
        shippingDate=null
    }

})

$('.datepicker').on('dp.change',function (e){
    let numberDate=$(this).data("DateTimePicker").date()._d.getDay();
        console.log(numberDate);
    if (numberDate!=undefined) {
        data={
            weekDate:numberDate
        }
        fetch('/getHours',
        { headers:{ 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),'Content-Type':'application/json'},
          body:JSON.stringify(data),
          method:"post"
        }).then(response=>response.json())
          .then((data)=>{
              console.log(data);
              datesObjects = data;
       //       console.log(datesObjects)
            $('#horarioSelect').empty();
            let firstOption='<option value="0" >Horarios disponibles</option>';
            $('#horarioSelect').append(firstOption);
            data.forEach((item)=>{
                if(item.limit != 0){
                    let option=`<option value="${item.id}">${item.init_hour} - ${item.fin_hour}</option>`;
                    $('#horarioSelect').append(option);
                }
            })

            console.log(shippingDate)

          })

    }else{
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Debe seleccionar Una fecha mayor al dia de hoy',
            showConfirmButton: false,
             timer: 1500
            });
    }

});





</script>
@endsection