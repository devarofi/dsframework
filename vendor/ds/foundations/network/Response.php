<?php

namespace Ds\Foundations\Network;

class Response
{
    public $isValid;
    public function __construct(bool $isValid = true)
    {
        $this->isValid = $isValid;
    }
}
