<?php
namespace App\Helpers;

use Ds\Foundations\Config\Env;
use Ds\Foundations\Network\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Encrypt {
  public static function decode(Request $request){
    $authorization = $request->headers['Authorization'];
    $bearer = substr($authorization, strpos($authorization, ' ') + 1);
    $key = new Key(Env::get('SECRET_KEY', 'MDA354'), 'HS256');
    $json = JWT::decode($bearer, $key);
    if(is_object($json)){
        return $json;
    }
    return false;
  }
}