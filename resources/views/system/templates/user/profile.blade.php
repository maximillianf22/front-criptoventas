@extends('system.layouts.global.index')
@section('title', 'Perfil')

@section('css')
<style>
  .pac-container {
    z-index: 10000 !important;
  }
</style>
@endsection

@section('content')
<div class="container">
  <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="section">
            <!-- User Information -->
            <section class="text-center p-1 bg-white shadow">
              <div class="fileinput fileinput-new text-center mt-4" data-provides="fileinput">
                <div class="fileinput-new thumbnail img-circle img-raised">
                  <img src="../assets/img/placeholder.jpg" alt="...">
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div>
              </div>
              <h3 class="title mt-0">{{ session('active_user')["get_user"]["name"]}}</h3>
            </section>
            <!-- User Information -->
            <!-- Profile Sidebar -->
            <div class="list-group list-group-flush mt-2 shadow">
              <button type="button" data-toggle="tab" href="#link1" role="tablist" class="list-group-item list-group-item-action text-center p-2 active">General</button>
              <button type="button" data-toggle="tab" href="#link2" role="tablist" class="list-group-item list-group-item-action text-center p-2">Direcciones</button>
              <button type="button" data-toggle="tab" href="#link3" role="tablist" class="list-group-item list-group-item-action text-center p-2">Historial de pedidos</button>
              <button type="button" data-toggle="tab" href="#link4" role="tablist" class="list-group-item list-group-item-action text-center p-2">Historial de domicilios</button>
            </div>
            <!-- End Profile Completion -->
          </div>
        </div>
        <div class="col-md-8 ml-auto p-0 m-0">
          <div class="section">
            <div class="tab-content">
              <div class="tab-pane active" id="link1">
                <div class="">
                  <header>
                    <h2 class="text-uppercase">Información General</h2>
                  </header>
                  <hr class="line-info">
                  <br>
                  @if (session()->has('danger'))
                  <div class="alert alert-danger" role="alert">
                    {{session('danger')}}
                  </div>
                  @endif
                  @if (session()->has('success'))
                  <div class="alert alert-info" role="alert">
                    {{session('success')}}
                  </div>
                  @endif
                  @if($errors->any())
                  <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    - {{$error}} <br>
                    @endforeach
                  </div>
                  @endif
                  <form action="{{route('profile.update')}}" method="post">
                    @csrf
                    @method('put')
                    @if(session('active_user')['get_user']['rol_id'] != 3)
                    <div class="row">
                      <div class="form-group col focused">
                        <label class="form-control-label" for="input-name">Tipo de documento</label>

                        <select name="document_type_vp" class="form-control" required="">
                          <option value="" selected="" disabled="">Selecione tipo documento</option>
                          @foreach ($document_vp as $item)
                          <option {{$item->id==AuthUser::data()->get_user->document_type_vp?'selected': ''}} value="{{$item->id}}">{{$item->name}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group col">
                        <label class="form-control-label" for="input-name">Documento</label>
                        <input type="text" name="document" value="{{ session('active_user')["get_user"]["document"]}}" id="input-name" class="form-control form-control-alternative" placeholder="Documento" required="">
                      </div>
                    </div>
                    @endif
                    <div class="row">
                      <div class="form-group col">
                        <label class="form-control-label" for="input-name">Nombre</label>
                        <input type="text" value="{{ session('active_user')["get_user"]["name"]}}" name="name" id="input-name" class="form-control form-control-alternative" placeholder="Nombre" required="">
                      </div>
                      <div class="form-group col">
                        <label class="form-control-label" for="input-name">Apellidos</label>
                        <input type="text" value="{{ session('active_user')["get_user"]["last_name"]}}" name="last_name" id="input-name" class="form-control form-control-alternative" placeholder="Apellidos" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col">
                        <label class="form-control-label" for="input-email">Email</label>
                        <input type="email" name="email" value="{{ session('active_user')["get_user"]["email"]}}" id="input-email" class="form-control form-control-alternative" placeholder="Correo electrónico">
                      </div>
                      <div class="form-group col">
                        <label class="form-control-label" for="input-email">Celular</label>
                        <input type="number" name="cellphone" value="{{ session('active_user')["get_user"]["cellphone"]}}" id="input-email" class="form-control form-control-alternative" placeholder="Celular" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col">
                        <label class="form-control-label" for="input-email">Actualizar Contraseña</label>
                        <input type="password" name="password" id="input-email" class="form-control form-control-alternative" placeholder="Contraseña">
                      </div>
                      <div class="form-group col">
                        <label class="form-control-label" for="input-email">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" id="input-email" class="form-control form-control-alternative" placeholder="Confirmar contraseña">
                      </div>
                    </div>
                    @if (session('active_user.get_user.rol_id')==4)

                    <div class="row">
                        <div class="form-group col">
                            <label class="form-control-label" for="input-email">Role</label>
                            <input value="Distribuidor" style="background-color: transparent" type="text" disabled type="password" name="dist" id="input-email" class="form-control form-control-alternative" placeholder="Distribuidor"  >
                        </div>
                        <div class="form-group col">
                            <label class="form-control-label" for="input-email">Codigo Distribuidor</label>
                            <input type="text" disabled style="background-color: transparent"   class="form-control form-control-alternative" value="{{session('active_user.distributor_code')}}" placeholder="codigo distribuidor"  >
                        </div>
                    </div>
                    @endif
                    @if (session()->has('active_user.dist'))
                    <div class="row">
                        <div class="form-group col">
                            <label class="form-control-label" for="input-email">Role</label>
                            <input value="Cliente" style="background-color: transparent" type="text" disabled type="password" name="dist" id="input-email" class="form-control form-control-alternative" placeholder="cliente"  >
                        </div>
                        <div class="form-group col">
                            <label class="form-control-label" for="input-email">Codigo Distribuidor</label>
                            <input type="text" disabled style="background-color: transparent"   class="form-control form-control-alternative" value="{{session('active_user.dist.distributor_code')}}" placeholder="codigo distribuidor"  >
                        </div>
                    </div>
                    @endif
                    <div >
                        <button type="submit" class="btn btn-info mt-4">Actualizar Información</button>
                    </div>
                </div>
              </div>
              </form>
              <div class="tab-pane" id="link2">
                <header>
                  <h2 class="text-uppercase">Mis Direcciones</h2>
                </header>
                <hr class="line-info">
                <br>
                <table class="table align-items-center" id="idListAddress">
                  <thead>
                    <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Direccion</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($addresses)>0)
                    @foreach ($addresses as $address)
                    <tr>
                      <th scope="row">{{$address->name}}</th>
                      <td>{{strlen($address->address)>25 ? substr($address->address, 0, 25) . "..." : $address->address}}</td>
                      <td>{{strlen($address->observation)>25 ? substr($address->observation, 0, 25) . "..." : $address->observation}}</td>
                      <td>
                        <button class="btn btn-info btn-sm" onclick="editAddressModal({{$address->id}})"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="deleteAddressModal({{$address->id}})"><i class="fas fa-trash-alt"></i></button>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td>No tiene direcciones registradas</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#idAddAddressModal">
                  <i class="fas fa-plus"></i> Añadir direccion
                </button>
              </div>
              <div class="tab-pane" id="link3">
                <header>
                  <h2 class="text-uppercase">Historial de Pedidos</h2>
                </header>
                <hr class="line-info">
                <br>
                <table class="table align-items-center">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Productos</th>
                      <th scope="col">Direccion</th>
                      <th scope="col">fecha</th>
                      <th scope="col">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($listOrders)>0)
                    @foreach ($listOrders as $orderItem)
                    <tr>
                      <th scope="row">
                        {{$orderItem->id}}
                      </th>
                      <td>
                        {{$orderItem->get_commerce->bussiness_name}}
                      </td>
                      <td>
                        {{$orderItem->get_address->address}}
                      </td>
                      <td>
                        {{$orderItem->date}}
                      </td>
                      <td>
                        <button type="submit" onclick="replay( {{$orderItem->id}})" class="btn btn-info btn-sm">
                          <i class="fas fa-history"></i> Repetir
                        </button>
                        <a href="/order/{{$orderItem->id}}" type="submit" class="btn btn-info btn-sm btn-icon btn-round">
                            <i class="fas fa-eye"></i>
                        </a>

                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td>No tiene Pedidos realizados</td>
                    </tr>
                    @endif

                    <!-- <tr>
                        <th scope="row">
                          1
                        </th>
                        <td>
                          <div class="avatar text-center" style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_COCO_2020_05_29_19_09_43.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                           <div class="avatar " style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_MANDARINA_2020_05_29_01_15_34.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                          <div class="avatar " style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_MANDARINA_2020_05_29_01_15_34.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                          <div class="avatar " style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_MANDARINA_2020_05_29_01_15_34.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                          <div class="avatar " style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_MANDARINA_2020_05_29_01_15_34.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                        </td>
                        <td >
                          Carrera 5 calle 70 # 87 - 201
                        </td>
                        <td>
                          <button type="submit" class="btn btn-info btn-sm btn-icon btn-round">
                            <i class="fas fa-eye"></i> Ver
                          </button>
                        </td>
                      </tr>
                      <tr>
                        <th scope="row">
                          1
                        </th>
                        <td>
                          <div class="avatar text-center" style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_COCO_2020_05_29_19_09_43.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                           <div class="avatar " style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_MANDARINA_2020_05_29_01_15_34.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                          <div class="avatar " style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_MANDARINA_2020_05_29_01_15_34.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                          <div class="avatar " style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_MANDARINA_2020_05_29_01_15_34.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                          <div class="avatar " style="height: 40px !important; width: 40px !important">
                            <img class="media-object img-raised" src="https://www.favores.co/storage/products/item_MANDARINA_2020_05_29_01_15_34.jpeg" alt="..." style="height: 90% !important;">
                          </div>
                        </td>
                        <td>
                          Carrera 5 calle 70 # 87 - 201
                        </td>
                        <td>
                          <button type="submit" class="btn btn-info btn-sm btn-icon btn-round">
                            <i class="fas fa-eye"></i> Ver
                          </button>
                        </td>
                      </tr> -->

                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="link4">
                <header>
                  <h2 class="text-uppercase">Mis Direcciones</h2>
                </header>
                <hr class="line-info">
                <br>
                <table class="table align-items-center" >
                  <thead>
                    <tr>
                      <th scope="col">Fecha</th>
                      <th scope="col">Referencia</th>
                      <th scope="col">seguir</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($favores)>0)
                    @foreach ($favores as $item)
                    <tr>
                      <td>{{$item['date']}} </td>
                      <td>{{$item['reference']}}</td>
                      <td>
                      <a href="{{config('app.domiciliosApp').'tracking/'.$item['reference']}}" target="_blank" class="btn btn-info btn-sm">ver</a>
                      </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td>No tiene domicilios registradas</td>
                    </tr>
                    @endif
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection

  @section('js')
  <script type="text/javascript">
    function addAddressModal() {
      $("#formAddAddressModal #text-validate").html("");

      var formData = new FormData(document.getElementById("formAddAddressModal"));

      var urlPath = urlHost + "/perfil/address/add";
      $.ajax({
        type: 'POST',
        url: urlPath,
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {},
        success: function(response) {
          if (response.state == 1) {
            $("#idAddAddressModal").modal('hide');
            $("#formAddAddressModal")[0].reset();
            $("#idListAddress").load(location.href + " #idListAddress>*", "");
          } else if (response.state == 2) {
            alert("Oops!. " + response.message);
          } else {
            alert("Oops!. Hemos tenido problemas, intenta nuevamente");
          }
        },
        error: function(xhr) {
          if (xhr.responseJSON.errors) {
            $.each(xhr.responseJSON.errors, function(index, value) {
              $("#formAddAddressModal #validate-" + index).html(value[0]);
            });

            alert("Oops!. Debe enviar los datos correctamente");
          } else {
            alert("Oops!. Hemos tenido problemas, intenta nuevamente");
          }
        }
      });
    }

    var address = null;

    function editAddressModal(idAddress) {
      address = null;
      var urlPath = urlHost + "/perfil/address/edit";
      $.ajax({
        type: 'POST',
        url: urlPath,
        data: {
          "idAddress": idAddress
        },
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {},
        success: function(response) {
          if (response.state == 1) {
            address = response.data.id;

            $("#idEditAddressName").val(response.data.name);
            $("#idEditAddressLat").val(response.data.lat);
            $("#idEditAddressLng").val(response.data.lng);
            $("#idEditAddressInput").val(response.data.address);
            $("#idEditAddressObservation").val(response.data.observation);

            $("#idEditAddressModal").modal();
          } else if (response.state == 2) {
            alert("Oops!. " + response.message);
          } else {
            alert("Oops!. Hemos tenido problemas, intenta nuevamente");
          }
        },
        error: function(xhr) {
          alert("Oops!. Hemos tenido problemas, intenta nuevamente");
        }
      });
    }

    function updateAddressModal() {
      $("#formEditAddressModal #text-validate").html("");

      var formData = new FormData(document.getElementById("formEditAddressModal"));
      formData.append('id', address);

      var urlPath = urlHost + "/perfil/address/update";
      $.ajax({
        type: 'POST',
        url: urlPath,
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {},
        success: function(response) {
          if (response.state == 1) {
            $("#idEditAddressModal").modal('hide');
            $("#formEditAddressModal")[0].reset();
            $("#idListAddress").load(location.href + " #idListAddress>*", "");
          } else if (response.state == 2) {
            alert("Oops!. " + response.message);
          } else {
            alert("Oops!. Hemos tenido problemas, intenta nuevamente");
          }
        },
        error: function(xhr) {
          if (xhr.responseJSON.errors) {
            $.each(xhr.responseJSON.errors, function(index, value) {
              $("#formEditAddressModal #validate-" + index).html(value[0]);
            });

            alert("Oops!. Debe enviar los datos correctamente");
          } else {
            alert("Oops!. Hemos tenido problemas, intenta nuevamente");
          }
        }
      });
    }

    function deleteAddressModal(id) {
      var bool = confirm("Deseas eliminar esta dirección");
      if (bool) {
        var urlPath = urlHost + "/perfil/address/delete";
        $.ajax({
          type: 'POST',
          url: urlPath,
          data: {
            "idAddress": id
          },
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function() {},
          success: function(response) {
              console.log(response)
            if (response.state == 1) {

                if (localStorage.dir!=null) {
                     let cacheDir=JSON.parse(localStorage.dir);
                     if (id==cacheDir.id) {
                    localStorage.clear()
                }
                }

              $("#idListAddress").load(location.href + " #idListAddress>*", "");
              alert("Bien!. " + response.message);
            } else if (response.state == 2) {
              alert("Oops!. " + response.message);
            } else {
              alert("Oops!. Hemos tenido problemas, intenta nuevamente");
            }
          },
          error: function(xhr) {
            alert("Oops!. Hemos tenido problemas, intenta nuevamente");
          }
        });
      }
    }
  </script>


  <script type="text/javascript">
    function initMap() {
      console.log("initMap");
      var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(4.511299, -74.170789),
        new google.maps.LatLng(4.769863, -74.024819)
      );

      autocompleteAddress = new google.maps.places.Autocomplete(
        document.getElementById('idAddAddressInput'), {
          bounds: defaultBounds,
          fields: ['geometry'],
        }
      );
      autocompleteAddress.addListener('place_changed', function() {
        let place = autocompleteAddress.getPlace()
        $('#idAddAddressLat').val(place.geometry.location.lat)
        $('#idAddAddressLng').val(place.geometry.location.lng)
        console.log("Place Changed");
      });

      autocompleteAddressEdit = new google.maps.places.Autocomplete(
        document.getElementById('idEditAddressInput'), {
          bounds: defaultBounds,
          fields: ['geometry'],
        }
      );
      autocompleteAddressEdit.addListener('place_changed', function() {
        let place = autocompleteAddressEdit.getPlace()
        $('#idEditAddressLat').val(place.geometry.location.lat)
        $('#idEditAddressLng').val(place.geometry.location.lng)
      });
        

    }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA01EIKVqGmy9BAhcDyT-nsJsLtBUbU_gA&libraries=places&callback=initMap"></script>
  @endsection
