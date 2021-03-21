@extends('system.layouts.global.index')
@section('title', 'Registro Proveedor')
@section('css')
<style>
  .pac-container {
    z-index: 10000 !important;
  }
</style>
@endsection
@section('content')
<!-- Header -->
<div class="wrapper section-signup m-0 p-0" style="background-image: url('{{asset('assets/img/bg/login.jpg')}}'); background-attachment: fixed; background-size:     cover;  background-repeat:   no-repeat;  background-position: center center;">
   <div class="page-header container-fluid" style="height: auto; max-height: 2000px;">
      <div class="squares square-1"></div>
      <div class="squares square1"></div>
      <div class="squares square2"></div>
      <div class="squares square3"></div>
      <div class="squares square-5"></div>
      <div class="squares square7"></div>
      <div class="squares square-7"></div>
      <div class="container">
      <form action="{{route('comercios.store')}}"  enctype="multipart/form-data" method="post">
        @csrf
        <div class="row" style="display: flex; justify-content: center;">

            <div class="col-md-4" style="display: none;">
                <div class="card card-profile shadow">
                    <h3 class="card-title mt-4">Foto del Comercio</h3>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail">
                        <img src="./assets/img/image_placeholder.jpg" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div>
                        <span class="btn btn-info btn-round btn-file">
                          <span class="fileinput-new">Subir foto</span>
                          <span class="fileinput-exists">Cambiar</span>
                          <input type="file" name="" />
                        </span>
                        <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Quitar</a>
                      </div>
                    </div>
                </div>
            </div>
            <div class="card bg-white shadow col-md-8">

                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">Crear comercio</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session()->has('errores'))
                        <div class="alert alert-danger">
                            @if (is_array(session('errores')))
                            @foreach(session('errores') as $error)
                            @foreach ($error as $item)
                            - {{$item}} <br>
                            @endforeach
                            @endforeach
                            @else
                             {{session('errores')}}
                            @endif
                        </div>
                      @endif
                        <h6 class="heading-small text-muted mb-4">Datos del usuario</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-name">Nombre *</label>
                                <input type="text" name="name" value="{{old('name')}}" id="input-name" class="form-control form-control-alternative" placeholder="Nombre" required="">
                                </div>
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-name">Apellidos *</label>
                                    <input type="text" name="last_name" value="{{old('last_name')}}" id="input-name" class="form-control form-control-alternative" placeholder="Apellidos" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-email">Nombre del Comercio*</label>
                                    <input type="text" name="bussiness_name" value="{{old('bussiness_name')}}" class="form-control form-control-alternative" placeholder="Nombre del comercio">
                                </div>
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-email">NIT *</label>
                                    <input type="number" name="nit" value="{{old('nit')}}" class="form-control form-control-alternative" placeholder="NIT" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-email">Email</label>
                                    <input type="email" name="email" value="{{old('email')}}" id="input-email" class="form-control form-control-alternative" placeholder="Correo electrónico">
                                </div>
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-email">Celular *</label>
                                    <input type="number" name="cellphone" value="{{old('celphone')}}" id="input-email" class="form-control form-control-alternative" placeholder="Celular" required="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label>Dirección del comercio *</label>
                                    <input type="text" name="commerce_address" value="" id="idAddAddressInput" class="form-control form-control-alternative" placeholder="Dirección del comercio" required="">
                                    <input type="hidden" name="lat" id="idAddAddressLat">
                                    <input type="hidden" name="lng" id="idAddAddressLng">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-email">Configuración domicilio*</label>
                                    <select name="delivery_config" class="form-control" required="">
                                        <option value="" disabled="" selected="">Seleccione un tipo de domicilio</option>
                                        @foreach ($tipoDomicilio as $item)
                                            <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-email">Tipo de comercio *</label>
                                    <select name="commerce_type_vp" class="form-control" required="">
                                        <option value="" disabled="" selected="">Seleccione un tipo de comercio</option>
                                        @foreach ($tipoComercio as $item)
                                            <option value="{{$item['id']}}" >{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-email">Contraseña *</label>
                                    <input type="password" name="password" id="input-email" class="form-control form-control-alternative" placeholder="Contraseña" required="">
                                </div>
                                <div class="form-group col">
                                    <label class="form-control-label" for="input-email">Confirmar contraseña *</label>
                                    <input type="password" name="password_confirmation" id="input-email" class="form-control form-control-alternative" placeholder="Confirmar contraseña" required="">
                                </div>
                            </div>
                            <div class="row">
                            <div class="custom-control custom-checkbox mt-2 col ml-5 text-center">
                                            <input class="custom-control-input" id="customCheck" name="terminos_y_condiciones" type="checkbox" required>
                                            <label class="custom-control-label" for="customCheck">
                                                <p><span>He leído y acepto los <a class="lina" href="{{asset('assets/terms/Politicas.pdf')}}" target="new" style="text-decoration: underline;">términos y condiciones</a></span></p>
                                            </label>
                              </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info mt-4">Crear comercio</button>
                        </div>
                    </div>
                </div>
         </div>
        </form>
      </div>
   </div>
</div>
@endsection
