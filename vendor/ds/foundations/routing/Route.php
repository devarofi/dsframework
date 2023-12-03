<?php

namespace Ds\Foundations\Routing;

use Closure;

abstract class Route
{
    const GET = 'GET';
    const POST = 'POST';
    static function get($url, Closure|array $target)
    {
        var_dump($_SERVER);
        if ($_SERVER['REQUEST_METHOD'] == self::GET) {
            if ($target instanceof Closure) {
            }
        }
    }
    static function post($url)
    {
    }
}
