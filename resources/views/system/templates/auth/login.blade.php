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
                @if (session()->has('danger'))
                <div class="alert alert-danger" role="alert">
                     {{session('danger')}}
                </div>
                @endif
               <div class="card card-contact card-raised p-3 bg-white">
                  <div class="card-header text-center">
                     <img src="{{ asset('assets/img/brand/logoa.png')}}" width="20%" class="d-none d-lg-block mx-auto" style="height: 71px;">
                     <h3 class="card-title text-dark display-3 mt-2"> <strong>Iniciar sesión</strong>...</h3>
                  </div>
                  <div class="card-body pb-0">
                    <!-- Formulario -->
                    @if (session()->has('success'))
                    <div class="alert alert-info" role="alert">
                         {{session('success')}}
                    </div>
                    @endif
                     <form role="form" method="POST" action="{{route('login.post')}}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group has-feedback">
                           <div class="input-group">
                              <div class="input-group-prepend">
                                 <span class="input-group-text"><i class="fa fa-phone text-info"></i></span>
                              </div>
                              <input id="cellphone" type="number" class="form-control" name="cellphone" placeholder="Numero de telefono" value="{{ old('cellphone') }}" required autofocus>
                           </div>
                        </div>
                        <div class="form-group has-feedback mb-0">
                           <div class="input-group mb-0">
                              <div class="input-group-prepend">
                                 <span class="input-group-text"><i class="fa fa-lock text-info"></i></span>
                              </div>
                              <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                              <!-- An element to toggle between password visibility -->
                            </div>
                            <div class="row">
                                <div class="col-4 offset-6 px-0"><label for="showPassword">Mostrar contraseña</label></div>
                                <div class="col-1 px-0 mt-1"><input id="showPassword" class="ml-auto" type="checkbox"></div>
                            </div>
                        </div>
                        <div class="card-footer text-center mt-1">
                           <div class="col-xs-12" style="padding-bottom: 9px;">
                              <button type="submit" class="btn btn-info btn-round btn-lg btn-block">Ingresar</button>
                           </div>
                        </div>
                     </form>
                  </div>
                    <!-- footer -->
                  <div class="card-footer text-center mt-0">
                     <div class="pull-left ml-3 mt-1 mb-3">
                        <h5 class="text-uppercase">
                           <a href="{{ url('/registro') }}" class="link footer-link text-dark">Registrarme</a>
                        </h5>
                     </div>
                     <div class="pull-right mr-3 mt-1 mb-3">
                        <h5 class="text-uppercase">
                           <a href="{{ url('/recovery') }}" class="link footer-link">¿Olvidó su clave?</a>
                        </h5>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
    $('#showPassword').change(()=>{

        if ($('#showPassword').prop('checked')) {
            $('#password').prop('type','text');
        }else{
            $('#password').prop('type','password');
        }
    })
    $('body').submit(()=>{
        localStorage.clear()
    })
</script>
@endsection
