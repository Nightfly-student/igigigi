<?php

class Role{
    private $roleId;
    private $roleName;

    public function getId(){
        return $this->roleId;
    }

    public function getRoleName(){
        return $this->roleName;
    }

    public function setId($value){
        $this->roleId = $value;
    }

    public function setRoleName($value){
        $this->roleName = $value;
    }
}