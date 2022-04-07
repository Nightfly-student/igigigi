<?php
// anel 
class Validator{
    private $pattern = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';
    private $phonePattern = '/^0\d{9,15}$/';

    public function validateTextInput($input, $minLength = 10)
    {
        if(empty($input)){
            return false;
        }elseif(strlen($input) < $minLength){
            return false;
        }else{
            return true;
        }
    }
    public function sanitize($data){
        $data = ltrim($data);
        $data = rtrim($data);
        return htmlspecialchars($data);
    }

    public function validateEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return false;
        }
    }

    public function validatePassword($password){
        if(preg_match($this->pattern, $password)) 
        return true;

        return false;
    }

    public function validatePhonenumber($phone){
        if(preg_match($this->phonePattern, $phone)){
            return true;
        }
        return false;
    }

}