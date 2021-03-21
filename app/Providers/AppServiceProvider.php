<?php

namespace App\Providers;

use App\Helpers\AuthUser;
use Illuminate\Support\ServiceProvider;

Use Blade;
use Gloudemans\Shoppingcart\Cart as ShoppingcartCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Http;
Use Session;

class AppServiceProvider extends ServiceProvider
{

  public function register()
  {
    //
  }

  public function boot()
  {
    Blade::if('isAuth', function () {
      if (Session::has('active_user')) {
        return true;
      }else{
        return false;
      }
    });
    view()->composer(['system.layouts.global.index'], function ($view) {
      $view->with('counterCart',Cart::content()->count());
      $view->with('Cart',Cart::content());
      $view->with('total',Cart::subtotal());

      if (session()->has('active_user')) {
        $id = AuthUser::data()->user_id;
        $response = Http::get(config('app.url_apiRequest').'api/client/getListAddress', [
          'id' => $id
        ]);
        $view->with('ListD',$response['data']??[]);
      }

    });

  }
}
