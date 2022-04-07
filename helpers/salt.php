<?php
class Salt
{
    //generates md5 from a random number which is used as a salt. 
    public function generateSalt()
    {
        $number = rand(1000, 9999);
        return md5($number);
    }
    //concat both given parameters and return it hashed
    public function hashPassword($password, $salt)
    {
        $pass = $password . $salt;
        $saltedHash = hash('sha256', $pass);
        return $saltedHash;
    }
}
