<?php

use App\Controllers\IndexController;
use Ds\Foundations\Common\Func;
use Ds\Foundations\Network\Request;
use Ds\Foundations\Routing\Route;

Route::get('/', [IndexController::class, 'index'])->middleware('http');

Route::get('/other', [IndexController::class, 'otherpage']);

Route::get('/waw', function () {
    echo 'GOod';
});

Route::get('/waw/blue', function () {
    echo 'page static';
});

Route::post('/new-data', function () {
    $request = new Request();
    return $request->json();
});
Route::middleware(['auth'], function () {
    Route::get('/waw/{arg1}/page/{good}', function ($arg1, $good) {
        echo 'page param ' . $arg1 . ' - ' . $good;
    });

    Route::get('/waw/page/{arg1}/{arg2}', function ($arg1, $arg2) {
        echo 'page ' . $arg1 . ' param';
    });
});
Route::group('admin', function () {
    Route::get('/get-string', function () {
        return ['username' => 'Dev'];
    });
});
