<?php
namespace App\Helpers;

use Session;

class AuthUser {
  public static function data() {
    if (Session::has('active_user')) {
      $result = Session::get('active_user');
      $response = json_decode(json_encode($result));
      return $response;
    }else{
      return "";
    }
  }
}
