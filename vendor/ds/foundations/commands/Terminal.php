<?php

namespace Ds\Foundations\Commands;

use Ds\Dir;
use Ds\Foundations\Commands\Serve\Server;
use Exception;

class Terminal
{
    private $args;
    private $commandList = [
        'serve' => Server::class
    ];

    public function __construct($argv)
    {
        Dir::init();
        $this->args = array_slice($argv, 1);
        $this->validate();
    }
    private function validate()
    {
        if (count($this->args) == 0) {
            echo ('Command can\'t be empty!');
            die();
        }
    }

    public function serve()
    {
        $command = $this->args[0];
        if (isset($this->commandList[$command])) {
            $options = count($this->args) > 1 ? array_slice($this->args, 1) : [];
            $runner = new $this->commandList[$command]($options);
            $runner->run();
        } else {
            echo ('Command [' . $this->args[0] . '] not found!');
            die();
        }
    }
}
