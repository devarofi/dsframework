<?php

use App\Controllers\IndexController;
use Ds\Foundations\Routing\Route;

// Route::get('/', [IndexController::class, 'index']);
Route::get('/other', [IndexController::class, 'otherpage']);
Route::get('/waw', function () {
    echo 'GOod';
});
Route::get('/waw/blue', function () {
    echo 'page static';
});
Route::get('/waw/{deva}/page', function () {
    echo 'page param';
});
Route::get('/waw/blue/page', function () {
    echo 'page not param';
});

class RoutePipe
{
    public array $child;
    public Closure $callback;

    public function __construct(Closure $callback)
    {
        $this->callback = $callback;
    }
}

$route_arr = [];

$route_arr['waw'] = new RoutePipe(function () {
    echo 'waw';
});
$route_arr['waw']->child['$'] = new RoutePipe(function () {
    echo 'waw/$';
});
$route_arr['waw']->child['$']->child['page'] = new RoutePipe(function () {
    echo 'waw/$/page';
});

$route_arr['waw']->child['blue'] = new RoutePipe(function () {
    echo 'waw/blue';
});
$route_arr['waw']->child['blue']->child['page'] = new RoutePipe(function () {
    echo 'waw/blue/page';
});

$sample_request = '/waw/blue';

function check($value)
{
    echo '<pre>';
    echo print_r($value, true);
    echo '</pre>';
}

function findRoute(string $uri)
{
    global $route_arr;
    check($uri);
    $array_uri = explode('/', $uri);
    foreach ($array_uri as $_uri) {
        check($_uri);
        if ($_uri != '') {
            if (isset($route_arr[$_uri])) {
                echo 'ada';
            }
        }
    }
}

findRoute($sample_request);
die();

echo '<pre>' . print_r($route_arr, true) . '</pre>';


die();
