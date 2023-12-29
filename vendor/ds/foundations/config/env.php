<?php

namespace Ds\Foundations\Config;

function env($key, $default = NULL)
{
    global $CACHE_CONFIG;
    return $CACHE_CONFIG[$key] ?? $default;
}
