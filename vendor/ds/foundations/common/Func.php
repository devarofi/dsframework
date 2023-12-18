<?php

namespace Ds\Foundations\Common;

class Func
{
    public static bool $isDebug = false;
    public static function check($value)
    {
        if (self::$isDebug) {
            echo '<pre>';
            echo print_r($value, true);
            echo '</pre>';
        }
    }
}
