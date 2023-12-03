<?php

namespace Ds\Core;

use Ds\Dir;
use Ds\Foundations\Controller\Controller;
use Ds\Foundations\Routing\RouteProvider;

class Ds
{
   private array $providers;
   public function __construct()
   {
      $this->providers = [
         new RouteProvider(),
         new Controller()
      ];
      Dir::init();
      $this->loadProviders();
   }
   private function loadProviders()
   {
      foreach ($this->providers as $provider) {
         $provider->install();
      }
      foreach ($this->providers as $provider) {
         $provider->run();
      }
   }
   public function connect()
   {
      printf('<pre>Connected</pre>');
   }
}
