<?php

namespace Ds\Foundations\Routing;

use Closure;

class RouteData
{
    public string $method;
    public string $path;
    public array|null $middlewares;
    public Closure|array $target;

    public function __construct(
        string $method,
        string $path,
        array|null $middlewares,
        Closure|array $target
    ) {
        $this->method = $method;
        $this->path = $path;
        $this->middlewares = $middlewares;
        $this->target = $target;
    }
}