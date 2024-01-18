<?php

use App\Controllers\AccountController;
use App\Controllers\IndexController;
use App\Controllers\PersonController;
use Ds\Foundations\Routing\Route;

Route::get('/', [IndexController::class, 'index'])->middleware('http');
Route::post('/access-token', [IndexController::class, 'getToken']);

Route::group('api', function(){
  Route::get('/person', [PersonController::class, 'index']);
  Route::post('/person/add', [PersonController::class, 'savePerson']);
  Route::post('/person/delete', [PersonController::class, 'deletePerson']);

  Route::group('user', function(){
    Route::post('/register', [AccountController::class, 'register']);
    Route::post('/login', [AccountController::class, 'login']);
  });
});
