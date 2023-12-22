<?php

namespace Ds\Foundations\Network;

class Request
{
    public function __construct()
    {
    }
    public function json()
    {
        return json_decode(file_get_contents('php://input'));
    }
    public function all()
    {
        return (array)$this->json();
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
