<?php

class Billing
{
    private int $billing_id;
    private string $billing_name;
    private string $billing_lastname;
    private string $billing_phone;
    private string $billing_address;
    private string $billing_country;

    public function getId() : int
    {
        return $this->billing_id;
    }
    public function getName() : string
    {
        return $this->billing_name;
    }
    public function getLastname() : string
    {
        return $this->billing_lastname;
    }
    public function getPhone() : string
    {
        return $this->billing_phone;
    }
    public function getAddress() : string
    {
        return $this->billing_address;
    }
    public function getCountry() : string
    {
        return $this->billing_country;
    }

    
    public function setId($value)
    {
        $this->billing_id = $value;
    }
    public function setName($value)
    {
        $this->billing_name = $value;
    }
    public function setLastname($value)
    {
        $this->billing_lastname = $value;
    }
    public function setPhone($value)
    {
        $this->billing_phone = $value;
    }
    public function setAddress($value)
    {
        $this->billing_address = $value;
    }
    public function setCountry($value)
    {
        $this->billing_country = $value;
    }

    public function fillObject($id, $name, $lastname, $phone, $address, $country){
        $this->billing_id = $id;
        $this->billing_name = $name;
        $this->billing_lastname = $lastname;
        $this->billing_phone = $phone;
        $this->billing_address = $address;
        $this->billing_country = $country;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
