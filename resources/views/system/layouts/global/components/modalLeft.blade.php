<div id="modal-left" class="modal fade" data-backdrop="true">
    <div class="modal-dialog modal-left w-xl">
        <div class="modal-content h-100 no-border-radius">
            <div class="modal-header" style="min-height: 13vh;max-height: 13vh;">
                <div class="modal-title text-md">
                   <a href="/" data-placement="bottom">
                     <img src="{{ asset('assets/img/brand/logoc.png')}}" width="50%">
                   </a>
                </div>
                <button data-dismiss="modal" class="btn btn-neutral"><img src="{{ asset('assets/img/brand/close.png')}}" width="40%"></button>
            </div>
            <div class="modal-body" style="min-height: 87vh; max-height: 87vh;  overflow-y: auto !important;"">
                @if(Route::current()->getName() === 'supermercados')
                  <div class="container">
                    <h4>Categorias</h4>
                      <ul class="list-unstyled">
                        @foreach($categories as $category)
                          <li class="text-dark text-left mb-3 border-bottom">
                            <a  class="text-info" href="{{route('supermercados',['id'=>10,'cat'=>$category->id])}}">
                              <i class="fas fa-caret-right"></i> <strong>{{$category->name}}</strong>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                  </div>
                @elseif(Route::current()->getName() === 'supermercado')
                  <div class="container">
                    <h4>Categorias</h4>
                      <ul class="list-unstyled">
                        @foreach ($Tcategories as $item)
                          <li class="text-dark text-left mb-3 border-bottom">
                            <a  class="text-info" href="{{route('supermercado',['id'=>$superMarket->id,'cat'=>$item['id']])}}">
                              <i class="fas fa-caret-right"></i> <strong>{{$item['name']}}</strong>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                  </div>
                 @elseif(Route::current()->getName() === 'restaurantes')
                  <div class="container">
                    <h4>Categorias</h4>
                      <ul class="list-unstyled">
                         @foreach ($categories as $item)
                          <li class="text-dark text-left mb-3 border-bottom">
                            <a  class="text-info" href="{{route('restaurantes',['id'=>9,'cat'=>$item->id])}}">
                              <i class="fas fa-caret-right"></i> <strong>{{$item->name}}</strong>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                  </div>
                @elseif(Route::current()->getName() === 'restaurante')
                  <div class="container">
                    <h4>Categorias</h4>
                      <ul class="list-unstyled">
                        @foreach ($Tcategories as $item)
                          <li class="text-dark text-left mb-3 border-bottom">
                            <a  class="text-info" href="{{route('restaurante',['id'=>$restaurant->id,'cat'=>$item['id']])}}">
                              <i class="fas fa-caret-right"></i> <strong>{{$item['name']}}</strong>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                  </div>
                @else
                  <div class="container border-top">
                      <ul class="list-unstyled mt-4">
                        <li class="text-dark text-left mb-3">
                          <a class="text-info" href="http://domicilios.criptoventas.com/register">
                            <i class="fas fa-motorcycle"></i>
                             Registro domiciliario
                            </a>
                          </li>
                         <li class="text-dark text-left mb-3">
                          <a class="text-info" href="{{ route('comercios.index')}}">
                            <i class="fa fa-home"></i>
                              Registro de aliado comercial
                            </a>
                          </li>
                        <li class="text-dark text-left mb-3">
                          <a class="text-info" href="{{ route('distribuidor.index')}}">
                            <i class="fas fas fa-handshake"></i>
                            Registro distribuidor
                          </a>
                        </li>
                      </ul>
                  </div>
                @endif
                <br>
                  <div class="container">
                  <h4>Más opciones</h4>
                    <ul class="list-unstyled">
                      <li class="text-dark text-left mb-3">
                        <a  class="text-info" href="{{ route('supermercados',['id'=>10])}}">
                          <i class="fas fa-caret-right"></i> Supermercados
                        </a>
                      </li>
                      <li class="text-dark text-left mb-3">
                        <a  class="text-info" href="{{ route('restaurantes',['id'=>9])}}">
                          <i class="fas fa-caret-right"></i> Restaurantes
                        </a>
                      </li>
                      <li class="text-dark text-left mb-3">
                        <a  class="text-info" href="">
                          <i class="fas fa-caret-right"></i> Productos Naturistas
                        </a>
                      </li>
                      <li class="text-dark text-left mb-3 dilifavor">
                        <a  class="text-info  " href="">
                          <i class="fas fa-caret-right"></i> Solicitar un domiclio
                        </a>
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
