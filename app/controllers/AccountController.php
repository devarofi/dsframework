<?php
namespace App\Controller;

use App\Models\Account;
use App\Models\AccountSecretKey;
use Ds\Foundations\Controller\Controller;
use Ds\Foundations\Network\Request;

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
        return $newAccount;
    }
    public function login(){
        
    }
}