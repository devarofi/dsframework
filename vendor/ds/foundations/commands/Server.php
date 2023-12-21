<?php

namespace Ds\Foundations\Commands;

use Ds\Helper\Str;

define('STRING_EMPTY', '');

class Server implements IRunner
{
    private $options = [];
    public function __construct($options = [])
    {
        $this->options = $options;
    }
    public function createSocketHost($host, $port, $error)
    {
        error_reporting(1);
        while (fsockopen($host, $port, $error) == TRUE) {
            $port++;
            echo "fail : $port\n";
        }
    }
    public function serve($_host)
    {
        // get directory target, if it's root=public/
        $dir = $this->options[0] ?? STRING_EMPTY;
        $_host = $_host == '' ? 'localhost' : $_host;
        // is command is run
        // get a new port for web server
        $root = ($dir == STRING_EMPTY || strstr('root', $dir) == STRING_EMPTY) ?
            '-t public/' : STRING_EMPTY;
        $port = 8000;
        $err = '';
        // check active port
        $this->createSocketHost($_host, $port, $err);

        if (trim($_host) != STRING_EMPTY) {
            $_serverRun = $_host . ':' . $port;
            echo ('Ds server started on http://' . $_serverRun .
                "\nCtrl+C to exit the server");
            // Open browser automatically
            $win = Str::contains($_SERVER['OS'], 'windows');
            $mac = Str::contains($_SERVER['OS'], 'mac');
            // For Windows OS
            if ($win)
                exec("explorer \"http://" . $_serverRun . "\"");
            if ($mac) ("open \"http://" . $_serverRun . "\"");

            // Start web server command
            exec('php -S ' . $_serverRun . ' ' . $root);
        } else {
            echo ('Failed to connect !');
        }
    }
    public function run()
    {
        echo ("Server was run\n");
        $this->serve($this->options[0] ?? null);
    }
}
