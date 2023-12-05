<?php

namespace App\Controllers;

use Ds\Foundations\Controller\Controller;

class IndexController extends Controller
{
    public function index()
    {
        echo 'Hello from controller';
    }
    public function otherpage()
    {
        echo 'From index to Other page';
    }
}
