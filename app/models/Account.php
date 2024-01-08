<?php
namespace App\Models;

use Ds\Foundations\Connection\Models\DsModel;

class Account extends DsModel {
  public $table = 'accounts';
  
  public function getAccounts(){
    return $this->select('accounts')->readAll();
  }
}