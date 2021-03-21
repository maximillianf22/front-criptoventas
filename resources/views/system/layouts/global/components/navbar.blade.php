<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm pt-2 pb-2 pr-1 pl-1 fixed-top" style="height: 65px;">
  <div class="container-fluid">
    <div class="align-items-center" style="width: 270px;  white-space: nowrap;">
        <a href="#" data-toggle="modal" data-target="#modal-left" data-toggle-class="modal-open-aside">
          <img src="{{ asset('assets/img/brand/menu.png')}}" class="no-border-radius" style="min-width: 45px; min-height: 35px; max-width: 45px; max-height: 35px">
        </a>
        <a class="navbar-brand m-0 p-0 showLoading" href="/" data-placement="bottom">
          <img src="{{ asset('assets/img/brand/logoc.png')}}" width="90%">
        </a>
    </div>
    @if(Route::current()->getName() != 'login')
    <div class="collapse border-right ml-0 mr-0 d-none d-sm-none d-md-block d-lg-block">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item  d-none d-sm-none d-md-none d-lg-block">
              <form method="get" action="{{route('buscador')}}" class="form-inline bg-light rounded text-nowrap ml-1 mr-1 bttn-search">
                <div class="form-group no-border" >
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-light ml-3 mr-2"><i class="fas fa-search text-info"></i></span>
                  </div>
                  <input name="keyWord" class="form-control bg-light text-dark ml-2 mr-5" placeholder="¿Qué producto buscas?" >
                </div>
              </form>
            </li>
            @isAuth
            <li class="nav-item  d-none d-sm-none d-md-block d-lg-block">
                <a class="form-inline rounded text-nowrap ml-2 mr-2" style="cursor: pointer;" data-toggle="modal" data-target="#modalSelectDireccion">
                  <div class="form-group no-border" >
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-light m-0 p-2 bttn-search">
                        <i class="fas fa-map-marker-alt mr-2 ml-3 text-info"></i>
                        <p style="color:;" class="mr-4 ml-3 text-info" id="navBarDir"> Selecciona una dirección</p>
                      </span>
                    </div>
                  </div>
                </a>
            </li>
            @endisAuth
            @if (empty(session('active_user')))
            <li class="nav-item  d-none d-sm-none d-md-block d-lg-block">
                <a href="/login" class="form-inline rounded text-nowrap ml-2 mr-2" style="cursor: pointer;" >
                  <div class="form-group no-border" >
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-light m-0 p-2 bttn-search">
                        <i class="fas fa-map-marker-alt mr-2 ml-3 text-info"></i>
                        <p style="color:;" class="mr-4 ml-3 text-info" > Selecciona una dirección</p>
                      </span>
                    </div>
                  </div>
                </a>
            </li>
            @endif
           {{--  <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#modalCupones" class="nav-item nav-link">
                  <img src="{{ asset('assets/img/brand/coupon.png')}}" class="no-border-radius" style="min-width: 32px; min-height: 24px; max-width: 32px; max-height: 24px">
              </a>
            </li> --}}
            <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#modal-right" data-toggle-class="modal-open-aside" class="nav-item nav-link">
                  <img src="{{ asset('assets/img/brand/cart.png')}}"  class="no-border-radius"style="min-width: 33px; min-height: 27px; max-width: 33px; max-height: 27px">
                  @if($counterCart == '0')
                   @else
                    <span id="cartCounter" class="badge badge-pill badge-info" style="padding-top: 6px; padding-left: 8px;padding-right: 8px;padding-bottom: 3px;">
                        {{$counterCart}}
                    </span>
                  @endif
                </a>
            </li>
        </ul>
    </div>
    @isAuth

        <div class="dropdown">
          <button class="btn btn-info btn-simple btn-round text-nowrap" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{AuthUser::data()->get_user->name}}
          </button>
          <div class="dropdown-menu bg-white shadow" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('perfil')}}"><i class="fas fa-user"></i> Perfil</a>
            <a class="dropdown-item logout" href="#"><i class="fas fa-sign-out-alt"></i> Salir</a>
          </div>
        </div>

    @else
        <a href="{{ route('registro.index')}}" class="btn btn-info btn-sm d-none d-sm-none d-md-block d-lg-block"><strong>Registrarse</strong></a>
        <a href="{{ route('login')}}" class="btn btn-info btn-sm"><strong>Ingresar</strong></a>
    @endisAuth
        @else
        <input type="button" value="Regresar" onclick="history.back(-1)"  class="btn btn-info btn-sm ml-auto">
    @endif
  </div>
</nav>
<div style="min-height: 4vh"></div>

