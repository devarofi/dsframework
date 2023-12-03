<?php

namespace Ds\Foundations\Routing;

use Closure;

abstract class Route
{
    const GET = 'GET';
    const POST = 'POST';
    public static function get($url, Closure|array $target)
    {
        var_dump($_SERVER);
        if ($_SERVER['REQUEST_METHOD'] == self::GET) {
            if ($target instanceof Closure) {
            }
        }
    }
    public static function post($url)
    {
    }
}
