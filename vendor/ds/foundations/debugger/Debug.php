<?php
namespace Ds\Foundations\Debugger;

use DebugBar\StandardDebugBar;
use Exception;

class Debug {
  private static StandardDebugBar $debugger;
  private static $debugbarRenderer;
  private static $isDebug;
  public static function init(){
    self::$debugger = new StandardDebugBar();
    self::$debugbarRenderer = self::$debugger->getJavascriptRenderer();
    self::$isDebug = true;
  }
  public static function log($args){
    if(self::$isDebug){
      self::$debugger['messages']->addMessage($args);
    }
  }
  public static function error(Exception $e){
    if(self::$isDebug){
      self::$debugger['exceptions']->addException($e);
    }
  }
  public static function writeLog(){
    if(self::$isDebug){
      echo self::$debugbarRenderer->renderHead();
      echo self::$debugbarRenderer->render();
    }
  }
}