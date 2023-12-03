<?php

namespace Ds;

spl_autoload_register(function ($name) {
    // check if $name is from DS namespace
    if (substr($name, 0, 3) == 'Ds\\') {
        require_once dirname(__DIR__) . '\\' . $name . '.php';
    } else {
        require_once dirname(dirname(__DIR__)) . '\\' . $name . '.php';
    }
});

abstract class Dir
{
    static string $APP;
    static string $ROUTE;
    static string $CONTROLLERS;
    static string $MODELS;
    static string $VIEWS;
    static string $MIDDLEWARES;
    static string $PROVIDERS;

    static function init()
    {
        self::$APP = dirname(__DIR__, 2) . '/app/';
        self::$ROUTE = self::$APP . 'route/';
        self::$CONTROLLERS = self::$APP . 'controllers/';
        self::$MODELS = self::$APP . 'models/';
        self::$VIEWS = self::$APP . 'views/';
        self::$MIDDLEWARES = self::$APP . 'middleware/';
    }
}
