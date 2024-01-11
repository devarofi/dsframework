<?php
namespace App\Models;

use Ds\Foundations\Connection\Models\DsModel;

class Person extends DsModel {
  public $table = 'person';
  
  public function getPersons(){
    return self::select('person')->readAll();
  }
}