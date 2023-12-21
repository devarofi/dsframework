<?php

namespace App\Middlewares;

use Ds\Foundations\Common\Func;
use Ds\Foundations\Network\Middleware;
use Ds\Foundations\Network\Request;
use Ds\Foundations\Network\Response;

class AuthMiddleware implements Middleware
{
    public function handle(Request $request, $next): Response|null
    {
        Func::check('Auth Middleware successfully!');
        return $next();
        // return null;
    }
}
