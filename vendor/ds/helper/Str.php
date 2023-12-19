<?php

namespace Ds\Helper;

class Str
{
    public static function contains(string $text, string $find): bool
    {
        return stristr($find, $text) != false;
    }
}
