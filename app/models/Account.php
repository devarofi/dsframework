<?php
namespace App\Models;

use Ds\Foundations\Common\Func;
use Ds\Foundations\Connection\Models\DsModel;

class Account extends DsModel {
  public $table = 'account';
  
  public function register($data){
    $secretWasUsed = $this->exist('secret', $data->secret);
    if(!$secretWasUsed){
      $accountSecret = AccountSecretKey::findBy('secret', $data->secret);
      $account = $this->save([
          'secret' => $data->secret,
          'id_person' => $accountSecret->id_person,
          'token' => $data->token,
          'username' => $data->username,
          'email' => $data->email,
      ], true);
      return $account;
    }
    return false;
  }
  public function login($data){
    return $this->select()->where([
      'email' => $data->email,
      'token' => $data->token,
    ])->get_row_object();
  }
}