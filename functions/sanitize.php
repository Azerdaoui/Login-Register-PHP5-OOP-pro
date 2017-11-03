<?php
/**
 * Created by PhpStorm.
 * User: othmane
 * Date: 18/03/16
 * Time: 14:28
 */

    function escape($string){
        return htmlentities($string,ENT_QUOTES,'UTF-8');
    }
    