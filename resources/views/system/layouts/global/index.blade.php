<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
      @yield('title', 'Inicio') | Criptoventas
    </title>
    <!-- Fonts and icons -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <!-- End Fonts and icons -->
    <!-- CSS Core Files -->
        <link href="{{ asset('assets/css/blk-design-system-pro.min.css?v=1.0.0')}}" rel="stylesheet" />
        <link href="{{ asset('assets/css/master.css')}}" rel="stylesheet" />
    <!-- End CSSS Core Files -->
    <!-- Carousel -->
        <!-- Css Carousel -->
            <link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
            <link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css" rel="stylesheet">
        <!-- Script Carousel -->
            <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js"></script>
            <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
    <!-- End Carousel -->
    @yield('css')

    <style type="text/css">
    .nav-pills .nav-item .nav-link {
    color: hsla(0, 0%, 100%, 0.8) !important;
    }

    </style>
</head>

<body class="index-page">
  <div id="loader-wrapper">
    <div id="loader"></div>
      <!-- Navbar -->
      @include('system.layouts.global.components.navbar')
      <!-- End Navbar -->
        <div class="main">
            <!-- Sidebar -->
                @yield('sidebar')
            <!-- Content -->
                    @yield('content')
            <!-- modalRight -->
                @include('system.layouts.global.components.modalRight')
            <!-- modalLeft -->
                @include('system.layouts.global.components.modalLeft')
            <!-- modals app -->
                @include('system.layouts.global.components.modals')
        </div>
      <div class="loader-section section-left"></div>
   <div class="loader-section section-right"></div>
</div>

<form id="createDelifavor" action="{{config('app.domiciliosApp')}}api/deliveryForm" style="display: none;" method="get" target="_blank">
    @if(session('active_user'))
        <input type="hidden" name="cellphone" value="{{session('active_user')['get_user']['cellphone']}}">
    @endif
</form>
<!-- Footer -->
    @yield('footer')
<!-- End Footer -->
    <script type='text/javascript' async defer>
      var protocol = window.location.protocol;
      var urlHost = protocol+"//"+"{{$_SERVER['HTTP_HOST']}}";
    </script>


@yield('js')
<!-- Core Scripts -->
    <script src="{{ asset('assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- End Core Scripts -->
<!-- Plugins Scripts -->
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-switch.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/slick.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('assets/js/plugins/anime.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-selectpicker.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/es.js') }}"></script>
<!-- BlkSystem JS -->

@yield('datapicker')
    <script src="{{ asset('assets/js/blk-design-system.min.js?v=1.0.0') }}" type="text/javascript"></script>
    <script>
         function replay(id) {
     fetch('/replay/cart/'+id).then(response=>response.json())
     .then((data)=>{
        console.log(data);
        Swal.fire({
            icon: 'info',
            title: data.message,
            showConfirmButton: false,
             timer: 1500
         }).then(()=>{
            if (data.data.length>0) {
              let html="";
            data.data.forEach((item)=>{
                html+=`- ${item.name} <br>`
            });
            Swal.fire({
            icon: 'info',
            html:html,
            title:"productos inactivos",
            showConfirmButton: false,
             timer: 1500
         })
        }
         window.location.reload()
         })



     })
 }
    function redirectSlide(url){
        window.open(url);
    }

        $('.dilifavor').on('click', function(){
            $('#createDelifavor').trigger('submit')
        })
       function getCountCart() {
            fetch('/carrito/0',{method:'get'})
                .then(response=>response.json())
                .then((data)=>{
                    $("#cartCounter").text(data.count)
                })
        }

        $('.showLoading').on('click', function(){
            let title=$(this).attr('data-lodingTitle');
            console.log(title);
            Swal.fire({
                title: title==null?'Cargando':title,
                allowEscapeKey: false,
                allowOutsideClick: false,
                background: '#e9ece',
                onOpen: () => {
                    Swal.showLoading();
                }
            })
        })
$('.logout').click(()=>{
    Swal.fire({
  title: '¿Esta seguro que desea salir?',
  text: "al salir se borrara el carrito de compras",
  icon: 'info',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'si, salir'
}).then((result) => {
  if (result.value) {
    Swal.fire(
      'ha cerrado session',
      'correctamente.',
    )
    window.location='/logout'
  }
})
}
)
/*        $(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
        return false;
    }
});
       document.onkeydown = function(e) {
        if (e.ctrlKey &&
            (e.keyCode === 67 ||
             e.keyCode === 86 ||
             e.keyCode === 85 ||
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
};
document.oncontextmenu = document.body.oncontextmenu = function() {return false;}  */
    </script>
 <style>
    .swal2-actions.swal2-loading .swal2-styled.swal2-confirm {
    box-sizing: border-box;
    width: 4.5em;
    height: 4.5em;
    margin: .46875em;
    padding: 0;
    -webkit-animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
    animation: swal2-rotate-loading 1.5s linear 0s infinite normal;
    border: .25em solid transparent;
    border-radius: 100%;
    border-color: transparent;
    background-color: transparent!important;
    color: transparent!important;
    cursor: default;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: url(http://grupowasser.com.mx/totalcarev2/assets/img/loader.png) !important;
    background-size: cover !important;
    background-repeat: no-repeat !important;
    border: none !important;
}
.swal2-actions {
    margin-top: 0 !important
}
</style>
</body>
