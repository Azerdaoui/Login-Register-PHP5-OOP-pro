<?php
/**
 * Created by PhpStorm.
 * User: othmane
 * Date: 18/03/16
 * Time: 14:23
 */

class Config {
    public static function get($path=null){
        if($path){
            $config= $GLOBALS['config'];
            $path=explode('/',$path);

            foreach($path as $bit){
                if(isset($config[$bit])){
                    $config=$config[$bit];
                }
            }
            return $config;
        }

        return false;
    }
    
} 