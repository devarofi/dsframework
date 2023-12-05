<?php

namespace Ds\Foundations\Routing;

use Closure;
use Ds\Dir;
use Ds\Foundations\Common\Func;
use Ds\Foundations\Provider;

use function Ds\Foundations\Common\check;

class RouteProvider implements Provider
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
    function install()
    {
        require_once Dir::$ROUTE . 'web.php';
        Func::check('RouteProvider installed !');
    }
    function run()
    {
        Func::check('RouteProvider running..');
        $uri = $_SERVER['REQUEST_URI'];
        if ($uri == '/') {
            $uri = '/index';
        }
        $request_uri = substr($uri, 1);
        Func::check($request_uri);
        $this->findRoute($request_uri);
    }
    public function findRoute(string $request)
    {
        $route_arr = RouteProvider::$routes;

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
    public function executeRoute(RouteData $route, array $params = [])
    {
        if ($route instanceof RouteData) {
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
        if (is_array($value)) {
            header('Content-Type:application/json');
            echo json_encode($value);
        } else {
            echo $value;
        }
    }
}
