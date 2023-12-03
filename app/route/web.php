<?php

use App\Controllers\IndexController;
use Ds\Foundations\Routing\Route;

Route::get('/', [IndexController::class, 'index']);
Route::get('/other', [IndexController::class, 'otherpage']);
Route::get('/waw', function () {
    echo 'GOod';
});
