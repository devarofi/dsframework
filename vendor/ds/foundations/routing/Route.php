<?php

namespace Ds\Foundations\Routing;

use App\Middlewares\Kernel;
use Closure;

abstract class Route extends Kernel
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
    private static array|null $middlewares;
    private static $EMPTY_ROUTE;
    private static function emptyRoute(): BaseRoute
    {
        if (self::$EMPTY_ROUTE == null) {
            self::$EMPTY_ROUTE = new BaseRoute();
        }
        return self::$EMPTY_ROUTE;
    }

    private static function registerRoute($url, Closure|array $target)
    {
        $route = new RouteData(
            $_SERVER['REQUEST_METHOD'],
            $url,
            self::$middlewares ?? null,
            $target
        );
        RouteProvider::addRoute($url, $route);
        return $route;
    }

    public static function get($url, Closure|array $target): BaseRoute
    {
        if ($_SERVER['REQUEST_METHOD'] == self::GET) {
            return self::registerRoute($url, $target);
        } else {
            return self::emptyRoute();
        }
    }
    public static function post($url, Closure|array $target): BaseRoute
    {
        if ($_SERVER['REQUEST_METHOD'] == self::POST) {
            return self::registerRoute($url, $target);
        } else {
            return self::emptyRoute();
        }
    }
    public static function put($url, Closure|array $target): BaseRoute
    {
        if ($_SERVER['REQUEST_METHOD'] == self::PUT) {
            return self::registerRoute($url, $target);
        } else {
            return self::emptyRoute();
        }
    }
    public static function delete($url, Closure|array $target): BaseRoute
    {
        if ($_SERVER['REQUEST_METHOD'] == self::DELETE) {
            return self::registerRoute($url, $target);
        } else {
            return self::emptyRoute();
        }
    }
    public static function middleware(array|string $middlewares, Closure $routes)
    {
        self::$middlewares = is_string($middlewares) ? [$middlewares] : $middlewares;
        $routes();
        self::$middlewares = null;
    }
}
