<?php
/**
 * Created by PhpStorm.
 * User: othmane
 * Date: 18/03/16
 * Time: 14:27
 */
    session_start();
    
    $GLOBALS['config']= array(
        'mysql'=>array(
            'host'      => 'localhost',
            'username'  => 'root',
            'password'  => 'root',
            'db'        => 'lr'
        ),
        'remember'=>array(
            'cookie_name'   => 'hash',
            'cookie_expiry' => 604800
        ),
        'session'=>array(
            'session_name'=> 'user',
            'token_name'  => 'token'
        )
    );

    spl_autoload_register(function($class){
        require_once 'classes/'.$class.'.php';
    });

    require_once 'functions/sanitize.php';
