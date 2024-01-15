<?php
namespace App\Models;

use Ds\Foundations\Connection\Models\DsModel;

class Account extends DsModel {
  public $table = 'accounts';
  
  public function register($data){
    // TODO: Check secret key was used
    $secretWasUsed = $this->exist('secret', $data->secret);
    return [$secretWasUsed];
    $accountSecret = AccountSecretKey::findBy('secret', $data->secret);
    $account = $this->save([
        'secret' => $data->secret,
        'id_person' => $accountSecret->id_person,
        'token' => $accountSecret->token,
        'username' => $accountSecret->username,
        'email' => $accountSecret->email,
    ], true);
    return $account;
  }
}