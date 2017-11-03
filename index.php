<?php

     require 'core/init.php';
     $userInsert = Database::getInstance()->update('users',1,array(
         'password' => 'newpassword'
     ));
     if($userInsert){
        //succes
        echo "Ajouter";
     }else{
        //no succes
        echo "no add";
     }