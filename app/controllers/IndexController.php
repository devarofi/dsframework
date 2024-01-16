<?php

namespace App\Controllers;

use Ds\Helper\Str;
use Ds\Foundations\Config\Env;
use Ds\Foundations\Controller\Controller;
use Ds\Foundations\Debugger\Debug;
use Ds\Foundations\Network\Request;
use Firebase\JWT\JWT;

class IndexController extends Controller
{
    public function index()
    {
        Debug::log('Test error handler in IndexController');
        $a = 1/0;
        view('welcome');
    }
    public function getToken(Request $request){
        if(Str::empty($request->access_token) || Str::empty($request->email))
        {
            return ['token' => null];
        }
        $payload = [
            'token' => $request->access_token,
            'email' => $request->email
        ];
        $secret_key = Env::get('SECRET_KEY');
        $jwt = JWT::encode($payload, $secret_key, 'HS256');
        return ['token' => $jwt];
    }
}
