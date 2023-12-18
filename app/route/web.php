<?php

use App\Controllers\IndexController;
use Ds\Foundations\Routing\Route;

Route::get('/', [IndexController::class, 'index']);

Route::get('/other', [IndexController::class, 'otherpage']);

Route::get('/waw', function () {
    echo 'GOod';
});

Route::get('/waw/blue', function () {
    echo 'page static';
});

Route::get('/waw/{arg1}/page/{good}', function ($arg1, $good) {
    echo 'page param ' . $arg1 . ' - ' . $good;
});

Route::get('/waw/page/{arg1}/{arg2}', function () {
    echo 'page not param';
});

Route::get('/get-json', function () {
    return ['username' => 'deva'];
});
Route::get('/get-string', function () {
    return 'Deva Arofi';
});
