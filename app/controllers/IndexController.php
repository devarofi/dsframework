<?php

namespace App\Controllers;

use App\Models\Account;
use App\Models\Person;
use Ds\Foundations\Config\Env;
use Ds\Foundations\Controller\Controller;
use Firebase\JWT\JWT;

class IndexController extends Controller
{
    public function index()
    {
        view('welcome');
    }
    public function getToken(){
        $payload = [
            'name' => 'muhamad deva arofi',
            'email' => 'deva@gmail.com'
        ];
        $secret_key = Env::get('SECRET_KEY');
        $jwt = JWT::encode($payload, $secret_key, 'HS256');
        return ['token' => $jwt];
    }
}
