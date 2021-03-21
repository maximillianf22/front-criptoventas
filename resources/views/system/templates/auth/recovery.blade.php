@extends('system.layouts.global.index')
@section('title', 'Login')
@section('content')
<!-- Header -->
<div class="wrapper section-signup m-0 p-0" style="background-image: url('{{asset('assets/img/bg/login.jpg')}}'); background-attachment: fixed; background-size:     cover;  background-repeat:   no-repeat;  background-position: center center;">
   <div class="page-header container-fluid">
      <div class="squares square1"></div>
      <div class="squares square2"></div>
      <div class="squares square3"></div>
      <div class="squares square4"></div>
      <div class="squares square5"></div>
      <div class="squares square6"></div>
      <div class="squares square7"></div>
      <div class="container">
         <div class="row">
            <div class="content-center text-left col-md-7 col-lg-4">
               <div class="card card-contact card-raised p-3 bg-white">
                  <div class="card-header text-center">
                     <img src="{{ asset('assets/img/brand/logoa.png')}}" width="20%" class="d-none d-lg-block mx-auto">
                     <h3 class="card-title text-dark display-3 mt-2"> <strong>Recuperar contraseña</strong>...</h3>
                     <small>Enviaremos un mensaje de texto al celular registrado con el código de verificación.</small>
                     @if(session('failed'))
                     <p><small class="text-danger">{{session('failed')}}</small></p>
                     @endif
                  </div>
                  <div class="card-body pb-0">
                     <!-- Formulario -->
                     <form role="form" method="post" action="{{route('sendCode')}}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <span class="input-group-text"><i class="fa fa-phone text-info"></i></span>
                              </div>
                              <input id="cellphone" type="number" class="form-control" name="cellphone" placeholder="Numero de telefono" required autofocus>
                           </div>

                        </div>
                        <div class="card-footer text-center">
                           <div class="col-xs-12" style="padding-bottom: 15px;">
                              <button type="submit" class="btn btn-info btn-round btn-lg btn-block">Enviar</button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <!-- footer -->
                  <div class="card-footer text-center mt-0">
                     <div class="pull-left ml-3 mt-2 mb-3">
                        <h5 class="text-uppercase">
                           <a href="{{ url('/login') }}" class="link footer-link text-dark">Ingresar</a>
                        </h5>
                     </div>
                     <div class="pull-right mr-3 mt-2 mb-3">
                        <h5 class="text-uppercase">
                           <a href="{{ url('/registro') }}" class="link footer-link">Registrarme</a>
                        </h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection