<?php

namespace App\Controllers;

use App\Models\Account;
use Ds\Foundations\Controller\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $data = Account::all();
        return ['data' => $data];
    }
    public function otherpage()
    {
        view('welcome');
    }
}
