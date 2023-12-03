<?php

namespace Ds\Foundations\Controller;

use Ds\Foundations\Provider;

class Controller implements Provider
{
    function install()
    {
        echo '<pre>Controller installed !</pre>';
    }
    function run()
    {
        echo '<pre>Controller running..</pre>';
    }
}
