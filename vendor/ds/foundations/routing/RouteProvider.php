<?php

namespace Ds\Foundations\Routing;

use Closure;
use Ds\Dir;
use Ds\Foundations\Provider;

class RouteProvider implements Provider
{
    public static array $routes;
    public function addRoute($path, Closure|array $options)
    {
        $this->routes[$path] = $options;
    }
    function install()
    {
        require_once Dir::$ROUTE . 'web.php';
        echo '<pre>RouteProvider installed !</pre>';
    }
    function run()
    {
        echo '<pre>RouteProvider running..</pre>';
    }
}
