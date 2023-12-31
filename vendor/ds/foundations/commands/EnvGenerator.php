<?php
namespace Ds\Foundations\Commands;

use Ds\Dir;
use Ds\Foundations\Config\AppEnv;

class EnvGenerator implements IRunner {
  function run(){
    $envFile = Dir::$MAIN.'.env';
    AppEnv::create($envFile);
  }
}