<?php

namespace Ds;

use Ds\Foundations\Config\AppEnv;

define('STRING_EMPTY', '');
define("ROOT", dirname(__DIR__, 2));

spl_autoload_register(function ($name) {
    // check if $name is from DS namespace
    if (substr($name, 0, 3) == 'Ds\\') {
        require_once dirname(__DIR__) . '\\' . $name . '.php';
    } else {
        require_once dirname(dirname(__DIR__)) . '\\' . $name . '.php';
    }
});
abstract class AppIndex {
    public static $SERVER_PROTOCOL;
    public static $HTTP_HOST;
    public static $BASE_URL;
    public static $BASE_ASSETS;
    public static $LINK_FILES;

    static function init(){
        require_once __DIR__.'/helper/Function.php';
        // your web server host (ex:localhost/index.php)
        self::$HTTP_HOST = $_SERVER['HTTP_HOST'];
        // Base url
        self::$BASE_URL = self::$SERVER_PROTOCOL.'://'.self::$HTTP_HOST;
        // Assets folder
        self::$BASE_ASSETS = self::$BASE_URL.'/assets/';
        // Asset files url
        self::$LINK_FILES = self::$BASE_URL. '/files/';
    }
}
abstract class Dir
{
    static string $MAIN;
    static string $APP;
    static string $ROUTE;
    static string $CONTROLLERS;
    static string $MODELS;
    static string $VIEWS;
    static string $MIDDLEWARES;
    static string $PROVIDERS;
    static string $STORAGE;
    static string $CACHE;
    static string $CONFIG_TEMP;
    static string $CACHE_VIEW;
    static string $CACHE_TIME;
    static string $VENDOR;

    static function init()
    {
        AppIndex::init();
        self::$MAIN = dirname(__DIR__, 2).'/';
        self::$APP = self::$MAIN . 'app/';
        self::$ROUTE = self::$APP . 'route/';
        self::$CONTROLLERS = self::$APP . 'controllers/';
        self::$MODELS = self::$APP . 'models/';
        self::$VIEWS = self::$APP . 'views/';
        self::$MIDDLEWARES = self::$APP . 'middleware/';
        self::$STORAGE = self::$MAIN . 'storage/';
        self::$CACHE = self::$STORAGE . 'cache/';
        self::$CACHE_VIEW = self::$CACHE.'views/';
        self::$CONFIG_TEMP = self::$CACHE . 'config.temp.php';
        self::$VENDOR = self::$MAIN. 'vendor/';
        self::$CACHE_TIME = self::$STORAGE.'cache/times/temp';
        include_once self::$CONFIG_TEMP;
    }
}