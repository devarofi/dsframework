<?php

include_once '../vendor/autoload.php';

use Ds\Core\Ds;
use DebugBar\StandardDebugBar;
use Ds\Foundations\Config\Env;

$debugbar = new StandardDebugBar();
$debugbarRenderer = $debugbar->getJavascriptRenderer();

$debugbar["messages"]->addMessage("hello world!");
$ds = new Ds();

$ds->connect();

if(Env::get('DEBUG_BAR') == 'true'){
  echo $debugbarRenderer->render();
}