<?php

namespace Ds\Core;

use Ds\AppIndex;
use Ds\Dir;
use Ds\Foundations\Common\Func;
use Ds\Foundations\Connection\DatabaseProvider;
use Ds\Foundations\Controller\Controller;
use Ds\Foundations\Exceptions\dsException;
use Ds\Foundations\Routing\RouteProvider;


class Ds
{
   private array $providers;
   public function __construct()
   {
      AppIndex::init();
      $this->providers = [
         new RouteProvider(),
         new Controller(),
         new DatabaseProvider()
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
      Func::check('Connected');
   }
}
