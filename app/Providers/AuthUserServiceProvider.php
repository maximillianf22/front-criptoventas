<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AuthUserServiceProvider extends ServiceProvider
{
  public function register()
  {
    require_once app_path() . '/Helpers/AuthUser.php';
  }

  public function boot()
  {
    //
  }
}
