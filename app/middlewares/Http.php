<?php

namespace App\Middlewares;

use Ds\Foundations\Common\Func;
use Ds\Foundations\Network\Middleware;
use Ds\Foundations\Network\Request;
use Ds\Foundations\Network\Response;

class Http implements Middleware
{
    function handle($request, $next): Response
    {
        return $next();
    }
}
