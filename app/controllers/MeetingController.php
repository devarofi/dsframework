<?php
namespace App\Controllers;
use Ds\Foundations\Controller\Controller;

/**
 * meeting Controller
 */
class meeting extends Controller
{
    public function index()
    {
        $data = array(
            'demoVariable' 		=> 'this is sample text variable'
        );
        view('meeting',$data);
    }
}