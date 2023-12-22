<?php

namespace Ds\Foundations\Network;

class Request
{
    public function __construct()
    {
    }
    public function __get($name)
    {
        switch ($name) {
            case 'headers':
                return headers_list();
            default:
                return $_REQUEST[$name];
        }
    }
}
