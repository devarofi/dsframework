<?php

namespace Ds\Foundations\Routing;

use Closure;
use Ds\Dir;
use Ds\Foundations\Provider;

class RouteProvider implements Provider
{
    private static array $routes;
    public static function addRoute($path, RouteData $options)
    {
        self::$routes[$path] = $options;
    }
    function install()
    {
        require_once Dir::$ROUTE . 'web.php';
        echo '<pre>RouteProvider installed !</pre>';
    }
    function run()
    {
        echo '<pre>RouteProvider running..</pre>';
        echo $_SERVER['REQUEST_URI'];
        echo '<pre>' . print_r(self::$routes, true) . '</pre>';
    }
}
