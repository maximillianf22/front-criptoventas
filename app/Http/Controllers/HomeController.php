<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $req = Http::get(config('app.url_apiRequest').'api/commerce/getCommercesCategories');
        $request = Http::get(config('app.url_apiRequest').'api/home/sliders');
        $request = json_decode($request);
        $req = json_decode($req);
        if ($req->code == 200 && $request->code == 200) {
            $categories = $req->data;
            $sliders = $request->data;
            return view('system.templates.home.index', ['categories' => $categories, 'sliders' => $sliders]);
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 0, $cat = 0)
    {
        $sliders = $this->Sliders();
        //id representa
        $commerces = $this->Commerces($id, $cat);
        //  10 supermercados 9 resturantes

        switch ($id) {
            case 9:
                $categories = $this->Categories(9);
                return view('system.templates.restaurant.list', ['restaurants' => $commerces, 'categories' => $categories, 'id' => $id, 'sliders' =>$sliders]);
                break;
            case 10:
                
                    $categories = $this->Categories(10);
                    return view('system.templates.supermarket.list', ['superMarkets' => $commerces[0]['get_commerces'], 'categories' => $categories, 'id' => $id, 'sliders' => $sliders]);
                
                break;
            default:
                return back();
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function Categories($tipo)
    {
        $req = Http::get(config('app.url_apiRequest').'api/commerce/getCommercesCategories');
        if ($req->status() == 200) {
            $req = json_decode($req);
            $categories = [];
            foreach ($req->data as $item) {
                if ($item->commerce_type == $tipo) {
                    $categories[] = $item;
                }
            }
            return $categories;
        }
    }
    public function Commerces($tipo, $cat = 0)
    {
        $commerces = [];
        $dir=!empty(session('dir'))?"&lat=".session('dir.lat')."&lng=".session('dir.lng'):"";
        $req = Http::get(config('app.url_apiRequest').'api/commerce/getCommercesByCategory?id=' . $cat.$dir);
        if ($req->status()==200) {
            $commerces = collect($req->json()['data']);
            $commerces = $commerces->where('commerce_type', $tipo);
            return $commerces;
        }
    }
    public function Sliders(){
        $sliders = [];
        $req = Http::get(config('app.url_apiRequest').'api/home/sliders');
        $req = json_decode($req);
        if($req->code == 200){
            $sliders=$req->data;
            return $sliders;
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSupermarkets($type){
        $commerces = [];
        $dir=!empty(session('dir'))?"&lat=".session('dir.lat')."&lng=".session('dir.lng'):"";
        $req = Http::get(config('app.url_apiRequest').'api/commerce/getCommercesByType?tipo=' . $type);
        if ($req->status()==200) {
            $commerces = $req->json()['data'];
            return $commerces;
        }

    }
}
