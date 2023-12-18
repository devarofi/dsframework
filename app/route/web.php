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

$GLOBALS['route_arr'] = [];

$GLOBALS['route_arr']['waw'] = new RoutePipe(function () {
    echo 'waw';
});
$GLOBALS['route_arr']['waw']->child['$'] = new RoutePipe(function () {
    echo 'waw/$';
});
$GLOBALS['route_arr']['waw']->child['$']->child['page'] = new RoutePipe(function () {
    echo 'waw/$/page';
});

$GLOBALS['route_arr']['waw']->child['blue'] = new RoutePipe(function () {
    echo 'waw/blue';
});
$GLOBALS['route_arr']['waw']->child['blue']->child['page'] = new RoutePipe(function () {
    echo 'waw/blue/page';
});

$sample_request = '/waw/blue';

function check($value)
{
    echo '<pre>';
    echo print_r($value, true);
    echo '</pre>';
}

function tree(string $nextPath, array $array_uri, RoutePipe $pipe)
{
    check(array_pop($array_uri));
}

function findRoute(string $uri)
{
    $route_arr = $GLOBALS['route_arr'];
    $array_uri = explode('/', $uri);
    foreach ($array_uri as $_uri) {
        if ($_uri != '') {
            if (isset($route_arr[$_uri])) {
                tree($_uri, $array_uri, $route_arr[$_uri]);
            }
        }
    }
}

findRoute($sample_request);
die();

echo '<pre>' . print_r($route_arr, true) . '</pre>';


die();
