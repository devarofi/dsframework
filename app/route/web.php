<?php

use App\Controllers\IndexController;
use App\Controllers\PersonController;
use App\Models\Account;
use Ds\Foundations\Common\Func;
use Ds\Foundations\Network\Request;
use Ds\Foundations\Routing\Route;

Route::get('/', [IndexController::class, 'index'])->middleware('http');
Route::get('/access-token', [IndexController::class, 'getToken']);

Route::group('api', function(){
  Route::get('/person', [PersonController::class, 'index']);
  Route::post('/person/add', [PersonController::class, 'savePerson']);
  Route::post('/person/delete', [PersonController::class, 'deletePerson']);
});
