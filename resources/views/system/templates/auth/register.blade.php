@extends('system.layouts.global.index')
@section('title', 'Registrto Cliente')
@section('content')
<style>
    a.lina:hover{
        color: black !important;
    }
</style>
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
                            <h3 class="card-title text-dark display-3 mt-2"> <strong>Registro de cliente</strong>...</h3>
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
                            <form role="form" method="post" action="{{route('registro.store')}}">
                                @csrf
                                <div class="container pt-0 pb-0 mt-0 mb-0">
                                    {{--
                                    <h5>Documento *</h5>
                                    <div class="row">
                                        <div class="form-group col focused">
                                            <select name="document_type_vp" class="form-control" required="">
                                                <option value="" selected="" disabled="">Selecione tipo documento</option>
                                                @foreach ($document_vp as $item)
                                                <option value="{{$item['id']}}">{{$item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col">
                                            <input value="{{old('document')}}" type="text" name="document" id="input-name" class="form-control form-control-alternative" placeholder="Documento" required="">
                                        </div>
                                    </div>
                                    --}}
                                    <div class="row">
                                        <div class="col"><h5>Nombre *</h5></div>
                                        <div class="col"><h5>Apellido *</h5></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <input value="{{old('name')}}" type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="Nombre" required="">
                                        </div>
                                        <div class="form-group col">
                                            <input value="{{old('last_name')}}" type="text" name="last_name" id="input-name" class="form-control form-control-alternative" placeholder="Apellidos" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col"><h5>email</h5></div>
                                        <div class="col"><h5>celular</h5></div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col">
                                            <input value="{{old('email')}}" type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="Correo electrónico">
                                        </div>
                                        <div class="form-group col">
                                            <input value="{{old('cellphone')}}" type="number" name="cellphone" id="input-email" class="form-control form-control-alternative" placeholder="Celular" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h5>Contraseña *</h5>
                                        </div>


                                        <div class="col">
                                            <h5>Confirmar contraseña *</h5>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group col">
                                            <input type="password" name="password" id="input-email" class="form-control form-control-alternative" placeholder="Contraseña" required="">
                                        </div>

                                        <div class="form-group col">
                                            <input type="password" name="password_confirmation" class="form-control form-control-alternative" placeholder="Confirmar contraseña" required="">
                                        </div>
                                    </div>
                                    <h5>Codigo de distribuidor</h5>
                                    <div class="row">
                                        <div class="form-group col">
                                            <input name="distributor_code" type="text" class="form-control form-control-alternative" placeholder="Codigo">
                                        </div>
                                        <div class="custom-control custom-checkbox mt-2 col ml-5">
                                            <input class="custom-control-input" id="customCheck" name="terminos_y_condiciones" type="checkbox" required>
                                            <label class="custom-control-label" for="customCheck">
                                                <a class="lina" href="{{asset('assets/terms/Politicas.pdf')}}" target="new"><span>He leido y <strong>Acepto los terminos y condiciones</strong></span></a>
                                            </label>
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
                                <h5 class="text-uppercase">
                                    <a href="{{route('login')}}" class="link footer-link text-dark">Iniciar Sesión</a>
                                </h5>
                            </div>
                            <div class="pull-right mr-3 mt-0 mb-3">
                                <h5 class="text-uppercase">
                                 {{--    <a href="{{ url('recovery')}}" class="link footer-link">¿Olvidó su clave?</a> --}}
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
