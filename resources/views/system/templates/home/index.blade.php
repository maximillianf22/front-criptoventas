@extends('system.layouts.global.index')
@section('title', 'Home')

@section('content')


  <!-- Section Header-->
  <div class=" container-fluid p-0 m-0 bg-white">
    @include('system.layouts.global.components.slider')
  <!-- Section Search addres-->
  <div class="container-fluid bg-white mt-5 rounded p-3">
      <div class="row">
        <div class="col-md-2 col-0"></div>
        <div class="col-md-8 col-12">
          <h1 class="text-info display-3 text-center">Seguro <strong class="text-secondary">encontrarás</strong> lo que buscas</h1>
        </div>
        <div class="col-md-2 col-0"></div>
      </div>
      <div class="row mb-3">
        <div class="col-md-2 col-0"></div>
        <div class="col-md-8 col-12">
        <form method="get" action="{{route('buscador')}}">
            <div class="row">
              <div class="col-sm-9">
                <div class="input-group no-border bttn-search rounded">
                  <div class="input-group-prepend no-border">
                    <span class="input-group-text bg-light no-border"><i class="fas fa-search text-info fa-2x mr-2"></i></span>
                  </div>
                  <input name="keyWord" type="text" class="form-control bg-light no-border form-control-lg" placeholder="¿Qué deseas buscar?" style="font-size: 1.2rem; color: #0ba7b1;">
                </div>
              </div>
              <div class="col-sm-3">
                <button type="submit" class="btn btn-info btn-lg btn-block"><strong style="font-size: 1.2rem;">Buscar</strong></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-2 col-0"></div>
      </div>
  </div>
  <!-- Section categories-->
  <div class="container mt-4 mb-3 rounded p-0">
    <h1 class="text-info display-3 mb-3 text-center">Nuestras Categorías</h1>
    <div class="row mx-auto mt-0">
      <div class="col-md-4 col-lg-3 col-xl-3 col-6">
        <a href="{{ route('supermercados',['id'=>10])}}" class="showLoading">
          <div class="card card-blog card-background categories mx-auto" data-animation="zooming">
            <div class="full-background" style="background-image: url('./assets/img/categories/supermercado.jpg')"></div>
          </div>
        </a>
        <h5 class="text-info text-center mt-3" style="font-size: 1.2rem">Supermercados</h5>
      </div>
      <div class="col-md-4 col-lg-3 col-xl-3 col-6">
        <a href="{{ route('restaurantes',['id'=>9])}}" class="showLoading">
          <div class="card card-blog card-background categories mx-auto" data-animation="zooming">
            <div class="full-background" style="background-image: url('./assets/img/categories/restaurantes.jpg')"></div>
          </div>
        </a>
        <h5 class="text-info text-center mt-3" style="font-size: 1.2rem">Restaurantes</h5>
      </div>
      <div class="col-md-4 col-lg-3 col-xl-3 col-6">
        <a href="http://criptoventas.com/supermercados/10/16" class="showLoading">
          <div class="card card-blog card-background categories mx-auto" data-animation="zooming">
            <div class="full-background" style="background-image: url('./assets/img/categories/farmacia.jpg')"></div>
          </div>
        </a>
        <h5 class="text-info text-center mt-3" style="font-size: 1.2rem">Farmacia</h5>
      </div>
      <div class="col-md-4 col-lg-3 col-xl-3 col-6">
        <div class="card card-blog card-background categories mx-auto dilifavor" data-animation="zooming">
          <div class="full-background" style="background-image: url('./assets/img/categories/favor.jpg')"></div>
        </div>
        <h5 class="text-info text-center mt-3" style="font-size: 1.2rem">Solicitar un Domicilio</h5>
      </div>
    </div>
  </div>
  <!-- Section Actions-->
  <section style="background-image: linear-gradient(to right, #cbe2ea, #cde9ec, #d1f0ed, #d8f6ec, #e2fbeb);" class="p-1">
    <div class="container mt-4 rounded">
      <h1 class="text-info display-3 text-center mt-4">Queremos que <strong class="text-secondary">seas nuestro:</strong></h1>
      <div class="row mb-4">
        <div class="col-md-6">
          <div class="row">
           <div class="col-5">
             <div class="p-0 m-0">
               <img src="{{asset('assets/img/ill/aliado.png')}}" class="">
             </div>
           </div>
           <div class="col-7">
             <h3 class="text-info mb-0"><strong>Aliado comercial</strong></h3>
             <h4 class="card-title text-info mb-0">Disfruta de las estrategias que tenemos para ti</h4><br>
             <a class="btn btn-info btn-sm mb-4" href="/comercios">Ver más</a>
           </div>
         </div>
        </div>
        <div class="col-md-6">
          <div class="row">
           <div class="col-5">
             <div class="p-0 m-0">
               <img src="{{asset('assets/img/ill/dilifavor.png')}}" class="">
             </div>
           </div>
           <div class="col-7">
             <h3 class="text-info mb-0"><strong>Domiciliario</strong></h3>
             <h4 class="card-title text-info mb-0">Disfruta de los beneficios que tenemos para ti</h4><br>
             <a class="btn btn-info btn-sm mb-4" href="http://domicilios.criptoventas.com/register">Ver más</a>
           </div>
         </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section app-->
  <div class="container mt-4 rounded bg-white">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-6">
            <h2 class="text-info mb-2 d-none d-sm-none d-md-none d-lg-block pr-0 mr-0" style="line-height: 1.2">
                <strong>
                  Descarga nuestra <br>
                  aplicación  y compra<br>
                  lo que más  te gusta<br>
                </strong>
            </h2>
            <h4 class="text-info mb-2 d-block d-sm-block d-md-block d-lg-none pr-0 mr-0" style="line-height: 1.2">
                <strong>
                  Descarga nuestra <br>
                  aplicación  y compra<br>
                  lo que mas  te gusta<br>
                </strong>
            </h4>
            <div class="row">
              <div class="col-lg-7 col-md-8 col-10 mb-3">
                <h5 class="mb-0 mt-2"><b>Disponible en</b></h5>
                <a href="https://play.google.com/" target="_blank"><img src="{{asset('assets/img/ill/playstore.png')}}" class="mt-1 bttn-search" width="85%"></a><br>
                <a href="https://apps.apple.com/" target="_blank"><img src="{{asset('assets/img/ill/appstore.png')}}" class="mt-2 bttn-search" width="85%"></a>
              </div>
              <div class="col-md-3 col-0">
              </div>
            </div>
          </div>
          <div class="col-6">
              <img src="{{asset('assets/img/ill/phone.png')}}" class="d-none d-sm-none d-md-block d-lg-block ml-auto pl-0 ml-0" style="max-width: 90%; min-width: 90%">
              <img src="{{asset('assets/img/ill/phone.png')}}" class="d-block d-sm-block d-md-none d-lg-none pl-0 ml-0" >
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-6">
            <h2 class="text-info mb-2 d-none d-sm-none d-md-none d-lg-block pr-0 mr-0" style="line-height: 1.2">
                <strong>
                  ¿Eres Domiciliario? <br>
                  descarga la aplicación<br>
                  aqui<br><br>
                </strong>
            </h2>
            <h4 class="text-info mb-2 d-block d-sm-block d-md-block d-lg-none pr-0 mr-0" style="line-height: 1.2">
                <strong>
                  ¿Eres Domiciliario? <br>
                  descarga la aplicación<br>
                  aqui<br><br>
                </strong>
            </h4>
            <div class="row">
              <div class="col-lg-7 col-md-8 col-10 mb-3">
                <h5 class="mb-0 mt-2"><b>Disponible en</b></h5>
                <a href="https://play.google.com/" target="_blank"><img src="{{asset('assets/img/ill/playstore.png')}}" class="mt-1 bttn-search" width="85%"></a><br>
                <a href="https://apps.apple.com/" target="_blank"><img src="{{asset('assets/img/ill/appstore.png')}}" class="mt-2 bttn-search" width="85%"></a>
              </div>
              <div class="col-md-3 col-0">
              </div>
            </div>
          </div>
          <div class="col-6">
              <img src="{{asset('assets/img/ill/domiciliario.png')}}" class="pl-0 ml-0 d-none d-sm-none d-md-block d-lg-block ml-auto" style="max-width: 90%; min-width: 90%">
              <img src="{{asset('assets/img/ill/domiciliario.png')}}" class="pl-0 ml-0 d-block d-sm-block d-md-none d-lg-none" >
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Section Valor-->
  <section style="background-image: linear-gradient(to right, #cbe2ea, #cde9ec, #d1f0ed, #d8f6ec, #e2fbeb);" class="p-1">
    <div class="container mt-3 mb-3">
    <h3 class="text-info display-3 text-center">Lo hacemos <strong class="text-secondary">por ti</strong></h3>
      <div class="row">
       <div class="col-md-4">
         <div class="row">
           <div class="col-6">
             <div class="mx-auto my-auto text-right pr-0">
               <img src="{{asset('assets/img/ill/compra.png')}}" class="">
             </div>
           </div>
           <div class="col-6 my-auto pl-0">
             <h3 class="card-title text-info">Compra <br>sin salir <br>de casa</h3>
           </div>
         </div>
       </div>
       <div class="col-md-4">
         <div class="row">
           <div class="col-6">
             <div class="mx-auto my-auto text-right pr-0">
               <img src="{{asset('assets/img/ill/envios.png')}}" class="">
             </div>
           </div>
           <div class="col-6 my-auto pl-0">
             <h3 class="card-title text-info">Envíos <br> garantizados</h3>
           </div>
         </div>
       </div>
       <div class="col-md-4">
         <div class="row">
           <div class="col-6">
             <div class="mx-auto my-auto text-right pr-0">
               <img src="{{asset('assets/img/ill/trabajamos.png')}}" class="">
             </div>
           </div>
           <div class="col-6 my-auto pl-0">
             <h3 class="card-title text-info">Trabajamos <br>en pro de ti</h3>
           </div>
         </div>
       </div>
      </div>
    </div>
  </section>
  </div>


@endsection
@if (session()->has('exito'))
<script>
  Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Su producto llegara pronto',
    showConfirmButton: false,
     timer: 1500
  })

</script>
@endif
@section('footer')
  @include('system.layouts.global.components.footer')
@endsection
