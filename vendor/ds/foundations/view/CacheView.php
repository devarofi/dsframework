<?php
namespace Ds\Foundations\View;

use Ds\Dir;

class CacheView
{
    private static $arr_times = null;
    private $dir_enc_cache;
    private $modified_time;
    private $result_last_time;

    public function detechRootUpdated($filename)
    {
        $source = file_get_contents($filename);
        $matches = [];
        preg_match_all('/\@use\(\'.*\'\)/i', $source, $matches);
        return count($matches[0]) > 0;
    }

    public function __construct($dir_enc_cache, $real_filename){
        $editedRoot = $this->detechRootUpdated($real_filename);
        
        if(self::$arr_times == null){
            self::$arr_times = require_once(Dir::$CACHE_TIME);
        }
        $this->dir_enc_cache = $dir_enc_cache;
        // // get modified time of file
        $this->modified_time = filemtime($real_filename);
        // // Get lastest status cache
        $this->result_last_time = $editedRoot ? 0 : $this->cache_record($this->dir_enc_cache);
    }
    private function cache_record($filename){
        return self::$arr_times[$filename] ?? 0;
    }
    public function is_modified()
    {
        return $this->result_last_time != $this->modified_time;
    }
    public function exists()
    {
        return file_exists($this->dir_enc_cache);
    }
    public function record_file()
    {
        $temp_list_item = "\t'".$this->dir_enc_cache.'\'=>\''.$this->modified_time."',";
        $temp_list_item_last = "\t'".$this->dir_enc_cache.'\'=>\''.$this->result_last_time."',";
        // Set new status cache
        $temp_content = file_get_contents(Dir::$CACHE_TIME);
        if(empty($this->result_last_time)){
            $temp_content = str_replace('];', $temp_list_item."\n];", $temp_content);
        }
        else{
            $temp_content = str_replace($temp_list_item_last, $temp_list_item, $temp_content);
        }
        file_put_contents(Dir::$CACHE_TIME, $temp_content);
    }
}