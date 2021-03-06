<?php
class Validation
{
    private $_passed = false,
            $_errors = array(),
            $_db = null;


    public function __construct()
    {
        $this->_db = Database::getInstance();
    }

    public function check($source, $items = array()){

        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $value = trim($source[$item]);
                $item = escape($item);

                if ($rule === 'required' && empty($value)) {
                    $this->addErrors("{$item} is required !!");
                }elseif(!empty($value)){
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addErrors($item." must be minimum of {$rule_value} characters");
                            }
                        break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addErrors($item." must be maximum of {$rule_value} characters");
                            }
                        break;
                        case 'matches':
                            if($value != $source[$rule_value]){
                                $this->addErrors("{$rule_value} must match {$item}");
                            }
                        break;

                        case 'unique':
                            $check = $this->_db->get($rule_value,array($item,'=',$value));
                            if($check->count()){
                                $this->addErrors("{item} already exists !!");
                            }
                        break;
                    }
                }
            }
        }
        if(empty($this->_errors)){
            $this->_passed=true;
        }
    }


    private function addErrors($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }
}