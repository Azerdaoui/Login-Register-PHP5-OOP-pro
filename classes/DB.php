<?php
/**
 * Created by PhpStorm.
 * User: othmane
 * Date: 18/03/16
 * Time: 14:23
 */

class DB {
    private static $_instance=null;

    private $_pdo,
            $_query,
            $_results,
            $_count=0,
            $_error;

    public function __construct(){
        try{
            $this->_pdo= new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
            //echo'connected!';
        }catch (Exception $e){
            die('Error :classes/DB.php'.$e->getMessage());
        }
    }

    public static function getInstance(){
        if(!isset(self::$_instance)){
            self::$_instance= new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params=array())
    {
        $this->_error=false;
        if($this->_query= $this->_pdo->prepare($sql)){
            $val=1;
            if(count($params)){
              foreach ($params as $param) {
                  $this->_query->bindValue($val,$param);
                  $val++;
              }
            }
            if($this->_query->execute()){
                $this->_results=$this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count=$this->_query->rowCount();
            }else{
                $this->_error=true;
            }
        }
        return $this;
    }

   /* public  function action($action,$table,$where=array()){
        if(count($where)===3){
            $operators= array('=','<','>','<=','>=');

            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if(in_array($operator,$operators)){
                $sql="{$action} FROM {$table} WHERE {$field} {$operator} ?";
               if($this->query($sql,array($value))==0){
                   return $this;
               }
            }
            return false;
        }
    }*/

    public function get($sql,$params){
        return $this->query($sql,$params);
    }

    //public function delete($table,$where){
    //}

    public function count(){
        return$this->_count;
    }

    public function error(){
        return $this->_error;
    }

    public function results(){
        return $this->_results;
    }

}
