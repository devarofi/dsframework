<?php

use App\Controllers\AccountController;
use App\Controllers\AnnouncementController;
use App\Controllers\IndexController;
use App\Controllers\MeetingsController;
use App\Controllers\PersonController;
use Ds\Foundations\Routing\Route;

Route::get('/', [IndexController::class, 'index'])->middleware('http');
Route::post('/access-token', [IndexController::class, 'getToken']);

// Route::group('/attr', PersonController::class);

Route::group('api', function(){

  Route::middleware('auth', function(){
    Route::get('/person', [PersonController::class, 'index']);
    Route::post('/person/add', [PersonController::class, 'savePerson']);
    Route::post('/person/delete', [PersonController::class, 'deletePerson']);

    Route::group('meetings', MeetingsController::class);
    Route::group('pengumuman', AnnouncementController::class);
  });

  Route::group('user', function(){
    Route::post('/register', [AccountController::class, 'register']);
    Route::post('/login', [AccountController::class, 'login']);
  });

});
