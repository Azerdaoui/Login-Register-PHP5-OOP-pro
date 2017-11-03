<?php
/**
 * Created by PhpStorm.
 * User: othmane
 * Date: 18/03/16
 * Time: 14:25
 */

class Token {
    public static function generate(){
        return Session::put(Config::get('session/token_name'),md5(uniqid()));
    }

    public static function check($token){
        $tokenName = Config::get('session/token_name');

        if(Session::exists($tokenName) && $token === Session::get($tokenName)){
            Session::delete($tokenName);

            return true;
        }

        return false;
    }
} 