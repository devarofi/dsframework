<?php
namespace App\Controllers;

use App\Models\Account;
use App\Models\AccountSecretKey;
use Ds\Foundations\Config\Env;
use Ds\Foundations\Controller\Controller;
use Ds\Foundations\Network\Request;
use Firebase\JWT\JWT;

/**
 * AccountController Controller
 */
class AccountController extends Controller
{
    public function index()
    {
        return ['data' => 'Account data'];
    }
    public function register(Request $request){
        $json = $request->json();
        $account = new Account();
        $newAccount = $account->register($json);
        if(is_bool($newAccount) && !$newAccount){
            return response(false, 'Token sudah digunakan!');
        }
        return response(true, $newAccount);
    }
    public function login(Request $request){
        $json = $request->json();
        $account = new Account();
        $userAccount = $account->login($json);
        if(is_bool($userAccount) && !$userAccount){
            return response(false, 'Password atau eamil salah!');
        }
        
        $payload = [
            'token' => $userAccount->token,
            'email' => $userAccount->email,
            'id_person' => $userAccount->id_person,
        ];
        $secret_key = Env::get('SECRET_KEY');
        $jwt = JWT::encode($payload, $secret_key, 'HS256');
        $userAccount->{'token'} = $jwt;

        return response(true, $userAccount);
    }
}