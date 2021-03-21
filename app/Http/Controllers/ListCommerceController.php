<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ListCommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = [];
        $commerces = [];
        if (!is_null(request()->id)) {
            $response = $this->request_commercesByCategory(request()->id);
            if ($response->status() == 200) {
                $commerces = $response->json()['data'];
            } else {
                request()->session()->flash('error', 'Error al listar los comercios');
            }
        }

        $response = $this->request_listCategories();
        if ($response->status() == 200) {
            $products = $response->json()['data'];
        } else {
            request()->session()->flash('error', 'Error al listar las categorias');
        }

        $data = array(
            'products' => $products,
            'commerces' => $commerces
        );

        return view('system.templates.supermarket.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $commerceId
     * @return \Illuminate\Http\Response
     */
    public function show($commerceId, $cat = 0)
    {

        $idUser = Session::has('active_user') ? session('active_user')['id'] : 0;
        $profile_vp=Session::has('active_user') ? session('active_user')['get_user']['rol_id'] : 0;
        $commerce = Http::get(config('app.url_apiRequest') . 'api/commerce/getCommerceDetails?id=' . $commerceId);
        $categories = Http::get(config('app.url_apiRequest') . "api/product/getProductsCategoriesList?idCommerce=$commerceId&idCustomer=$idUser&idCategory=" . $cat);
        $sliders = Http::get(config('app.url_apiRequest') . 'api/sliders/byCommerce?commerce_id=' . $commerceId)['data'] ?? [];

        $offers=Http::get(config('app.url_apiRequest') . "api/oferts?idCommerce=$commerceId&profile_vp= $profile_vp")['data'] ?? [];
        $outstanding=Http::get(config('app.url_apiRequest') . "api/outstanding?idCommerce=$commerceId&profile_vp= $profile_vp")['data'] ?? [];

        if ($commerce->status() == 200 && $categories->status()) {
            $commerce = json_decode($commerce);
            $Tcategories = $this->Categories($commerceId);

            if ($categories->status() == 200) {
                $categories = json_decode($categories);
                $categories = $categories->data;
            }

            $subcategories = [];

            foreach ($Tcategories as $key => $value) {
                if($value['parent']){
                    $subcategories[] = $value;
                    unset($Tcategories[$key]);
                }
            }
            foreach ($Tcategories as $key => $value) {
                foreach ($subcategories as $key1 => $value) {
                    if($Tcategories[$key]['id'] == $subcategories[$key1]['parent']){
                    $Tcategories[$key]['subcategories'][]= $subcategories[$key1];
                }
            }
            }
       
            //  10 supermercados 9 resturantes
            $tipo = $commerce->data->commerce_type_vp;
            switch ($tipo) {
                case 9:
                    return view(
                        'system.templates.restaurant.index',
                        [
                            'restaurant' => $commerce->data,
                            'categories' => $categories,
                            'Tcategories' => $Tcategories,
                            'cat' => $cat,
                            'offers'=>$offers,
                            'sliders' => $sliders,
                            'outstanding'=>$outstanding
                        ]
                    );
                    break;
                case 10:
                    return view(
                        'system.templates.supermarket.index',
                        [
                            'superMarket' => $commerce->data,
                            'categories' => $categories,
                            'Tcategories' => $Tcategories,
                            'sliders' => $sliders,
                            'cat' => $cat,
                            'offers'=>$offers,
                            'outstanding'=>$outstanding

                        ]
                    );
                    break;
                default:
                    return back();
                    break;
            }
        }else{
             abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $commerceId
     * @return \Illuminate\Http\Response
     */
    public function edit($commerceId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $commerceId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $commerceId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $commerceId
     * @return \Illuminate\Http\Response
     */
    public function destroy($commerceId)
    {
        //
    }
    public function onlyProducts($keyWord,$commerce)
    {
        $idCustomer=session('active_user.id')??0;
        $res=Http::get("http://multitiendafavores.ventual.co/api/seachProducts?idCustomer=$idCustomer&keyWord=$keyWord&idCommerce=$commerce");
        $data=$res['data']??[];
        return view('system.templates.supermarket.onlyProduct',['data'=>$data]);
    }

    /***** Funciones *****/
    public function Categories($comercio)
    {
        $commerce = Http::get(config('app.url_apiRequest') . 'api/commerce/getCommerceProductsCategories?id=0');
        $categories = [];
        if ($commerce->status() == 200) {
            foreach ($commerce['data'] as $item) {
                if ($item['commerce_id'] == $comercio) {
                    $categories[] = $item;
                }
            }
            return $categories;
        }
    }
    public function showProduct($pruductId)
    {
        $idUser = Session::has('active_user') ? Session('active_user')['id'] : 0;

        $product = Http::get(config('app.url_apiRequest') . 'api/product/getProductDetails?searchID=' . $pruductId . '&idCustomer=' . $idUser);


        if (!empty($product['data']['getRestaurantProduct'])) {
            $idRestaurantProduct = $product['data']['getRestaurantProduct']["id"];
            $product = collect([$product['data']]);
            $ingre = Http::get(config('app.url_apiRequest') . 'api/product/getProductIngredients?restaurant_product_id=' . $idRestaurantProduct);
            $ingredientees = [];
            if ($ingre['code'] == 200) {
                $ingredientees = $ingre['data'];
            }
            return response()->json(["product" => $product, "ingr" => $ingredientees, 200]);

            # code...
        }
        $product = json_decode($product);
        return response()->json($product, 200);
    }
}
