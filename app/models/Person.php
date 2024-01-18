<?php
namespace App\Models;

use Ds\Foundations\Connection\Db;
use Ds\Foundations\Connection\Models\DsModel;

class Person extends DsModel {
  public $table = 'person';
  
  public function getAll(){
    return $this->select()->orderBy('name')->get_assoc();
  }
  public function getSummary(){
    return $this->select([Db::raw('COUNT(id)') => 'total', 'group_name'], $this->table)->groupBy('group_name')->readAll();
  }
}