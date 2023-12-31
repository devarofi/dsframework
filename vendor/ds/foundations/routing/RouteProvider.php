<?php

namespace Ds\Foundations\Routing;

use App\Middlewares\Kernel;
use Closure;
use Ds\Dir;
use Ds\Foundations\Common\Func;
use Ds\Foundations\Network\Middleware;
use Ds\Foundations\Network\Request;
use Ds\Foundations\Network\Response;
use Ds\Foundations\Provider;

class RouteProvider extends Kernel implements Provider
{
    private static array $routes;
    public static function addRoute($path, RouteData $options)
    {
        if ($path == '/') {
            $path = '/index';
        }
        $path = substr($path, 1);
        self::$routes[$path] = $options;
    }
    public static function assignMiddleware($path, string|array $middleware)
    {
        return self::$routes[$path]->middleware($middleware);
    }
    function install()
    {
        require_once Dir::$ROUTE . 'web.php';
        Func::check('RouteProvider installed !');
    }
    function run()
    {
        Func::check('RouteProvider running..');
        $uri = $_SERVER['PATH_INFO'] ?? '/';
        if ($uri == '/') {
            $uri = '/index';
        }
        $request_uri = substr($uri, 1);
        Func::check($request_uri);
        $this->findRoute($request_uri);
    }
    public function findRoute(string $request)
    {
        $route_arr = self::$routes;

        $arr_request = explode('/', $request);
        $rqc = count($arr_request);
        $iterate = 0;
        foreach ($route_arr as $route => $callback) {
            $arr_route = explode('/', $route);
            $args = [];

            $isRight = 0;
            $rtc = count($arr_route);
            if ($rtc == $rqc) {
                for ($i = 0; $i < $rtc; $i++) {
                    if ($arr_route[$i][0] != '{') {
                        if ($arr_route[$i] == $arr_request[$i]) {
                            $isRight++;
                        }
                    } else {
                        $isRight++;
                        $argName = trim($arr_route[$isRight - 1], '{}');
                        $argValue = $arr_request[$isRight - 1];
                        $args[$argName] = $argValue;
                    }
                    $iterate++;
                }
            }
            if ($isRight == $rtc) {
                Func::check('Route is : '  . $route);
                $this->executeRoute($callback, $args);
                break;
            }
        }

        Func::check('Iterating : ' . $iterate);
    }
    public function validateMiddleware(RouteData $route): bool
    {
        $middlewares = null;
        if (is_string($route->middlewares)) {
            $middlewares = [$route->middlewares];
        } else if (is_array($route->middlewares)) {
            $middlewares = $route->middlewares;
        }
        // execute middleware 
        $countMiddlewares = count($middlewares);
        $continue = new Response();
        for ($i = 0; $i < $countMiddlewares; $i++) {
            $mName = $middlewares[$i];
            if (!isset($this->middlewareAlias[$mName])) {
                // TODO Error middleware not registered
                echo 'Middleware \'' . $mName . '\' not registered!';
                die();
            }
            $classM = new $this->middlewareAlias[$mName]();
            $continue = $classM->handle(new Request(), function () {
                return new Response();
            }) ?? new Response(false);

            if (!$continue->isValid) {
                echo 'Stopped by middleware validation';
                die();
            }
        }
        return true;
    }
    public function executeRoute(RouteData $route, array $params = [])
    {
        if ($route instanceof RouteData) {
            if ($route->middlewares != null) {
                if (!$this->validateMiddleware($route)) {
                    return; // TODO Route Validation
                }
            }
            $response = null;
            if (is_array($route->target)) {
                $obj = new $route->target[0]();
                $route->target[0] = $obj;
                $response = call_user_func_array($route->target, $params);
            } else if ($route->target instanceof Closure) {
                $response = call_user_func_array($route->target, $params);
            }
            $this->response($response);
        }
    }
    function response($value)
    {
        if (is_array($value) || is_object($value)) {
            header('Content-Type:application/json');
            echo json_encode($value);
        } else {
            echo $value;
        }
    }
}
