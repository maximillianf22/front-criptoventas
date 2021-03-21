@extends('system.layouts.global.index')
@section('title', 'Registrto Cliente')
@section('content')
<!-- Header -->
<div class="wrapper section-signup m-0 p-0" style="background-image: url('{{asset('assets/img/bg/login.jpg')}}'); background-attachment: fixed; background-size:     cover;  background-repeat:   no-repeat;  background-position: center center;">
   <div class="page-header container-fluid" style="height: auto; max-height: 2000px;">
      <div class="squares square-1"></div>
      <div class="squares square-2"></div>
      <div class="squares square-3"></div>
      <div class="squares square-4"></div>
      <div class="squares square-5"></div>
      <div class="squares square-6"></div>
      <div class="squares square-7"></div>
      <div class="container">
         <div class="row">
            <div class="content-center text-left col-md-7 col-lg-6">
               <div class="card card-contact card-raised p-3 bg-white">
                  <div class="card-header text-center">
                     <h3 class="card-title text-dark display-3 mt-2"> <strong>Registro de Distribuidor</strong></h3>
                  </div>
                  <div class="card-body pb-0">
                    <!-- Formulario -->
                    @if (session()->has('danger'))
                    <div class="alert alert-danger" role="alert">
                         {{session('danger')}}
                    </div>
                    @endif

                    @if($errors->any())
                      <div class="alert alert-danger">
                          @foreach($errors->all() as $error)
                          - {{$error}} <br>
                          @endforeach
                      </div>
                    @endif
                    <form role="form" method="post"  action="{{route('distribuidor.store')}}">
                         @csrf
                        <div class="container pt-0 pb-0 mt-0 mb-0">
                        <h6>Nombre*</h6>
                          <div class="row">
                              <div class="form-group col">
                                  <input  value="{{old('name')}}" type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="Nombre" required="">
                              </div>
                              <div class="form-group col">
                                  <input  value="{{old('last_name')}}" type="text" name="last_name" id="input-name" class="form-control form-control-alternative" placeholder="Apellidos" required="">
                              </div>
                          </div>
                        <h6>email*</h6>
                          <div class="row">
                              <div class="form-group col">
                                  <input  value="{{old('email')}}" type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="Correo electrónico">
                              </div>
                              <div class="form-group col">
                                  <input   value="{{old('cellphone')}}" type="number" name="cellphone" id="input-email" class="form-control form-control-alternative" placeholder="Celular" required="">
                              </div>
                          </div>
                        <h6>Contraseña*</h6>
                          <div class="row">
                              <div class="form-group col">
                                  <input type="password" name="password" id="input-email" class="form-control form-control-alternative" placeholder="Contraseña" required="">
                              </div>
                              <div class="form-group col">
                                  <input type="password" name="password_confirmation"   class="form-control form-control-alternative" placeholder="Confirmar contraseña" required="">
                              </div>
                          </div>

                       </div>
                        <div class="card-footer text-center pt-0 mt-0 pb-0 mb-0">
                           <div class="col-xs-12">
                              <button type="submit" class="btn btn-info btn-round btn-lg btn-block">Registrame</button>
                           </div>
                        </div>
                     </form>
                  </div>
                    <!-- footer -->
                  <div class="card-footer text-center mt-0">
                     <div class="pull-left ml-3 mt-0 mb-3">
                        <h6>
                           <a href="{{route('login')}}" class="link footer-link text-dark">Iniciar Sesión</a>
                        </h6>
                     </div>
                     <div class="pull-right mr-3 mt-0 mb-3">
                        <h6>
                           <a href="{{ url('recovery')}}" class="link footer-link">¿olvido su clave?</a>
                        </h6>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
