<?php

namespace Ds\Foundations\Routing;

use App\Middlewares\Kernel;
use Closure;

abstract class Route extends Kernel
{
    const GET = 'GET';
    const POST = 'POST';
    private static array|null $middlewares;

    public static function get($url, Closure|array $target)
    {
        if ($_SERVER['REQUEST_METHOD'] == self::GET) {
            RouteProvider::addRoute($url, new RouteData(
                Route::GET,
                $url,
                self::$middlewares ?? null,
                $target
            ));
        }
    }
    public static function post($url)
    {
    }
    public static function middleware(array|string $middlewares, Closure $routes)
    {
        self::$middlewares = is_string($middlewares) ? [$middlewares] : $middlewares;
        $routes();
        self::$middlewares = null;
    }
}
