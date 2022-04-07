<?php
class AdminUser
{
    private int $users_id;
    private int $role_id;
    private string $username;
    private ?int $billing_info_id = null;
    private ?Billing $billingInfo = null;
    private string $email;
    private string $password;
    private string $salt;
    private string $role_name;

    public function setBillingInfo($info)
    {
        $this->billingInfo = $info;
    }
    
    public function getBillingInfo(): ?Billing
    {
        return $this->billingInfo;
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getUserId(): int
    {
        return $this->users_id;
    }
    
    public function getUserRoleId(): int
    {
        return $this->role_id;
    }
    
    public function getBillingId(): ?int
    {
        return $this->billing_info_id;
    }
    
    public function getEmail(): string
    {
        return $this->email;
    }
    
    public function getPassword(): string
    {
        return $this->password;
    }
    
    public function getSalt(): string
    {
        return $this->salt;
    }
    
    public function getUserRole(): string
    {
        return $this->role_name;
    }

    public function setUsername($value)
    {
        $this->username = $value;
    }
    
    public function setUserId($value)
    {
        $this->users_id = $value;
    }
    
    public function setUserRoleId($value)
    {
        $this->role_id = $value;
    }
    
    public function setBillingId($value)
    {
        $this->billing_info_id = $value;
    }
    
    public function setEmail($value)
    {
        $this->email = $value;
    }
    
    public function setPassword($value)
    {
        $this->password = $value;
    }
    
    public function setSalt($value)
    {
        $this->salt = $value;
    }

    public function setUserRole($value)
    {
        $this->role_name = $value;
    }

    public function fillObject($id, $roleId, $username, $billingId = null, $billingInfo = null, $email, $password, $salt, $roleName){
        $this->users_id = $id;
        $this->role_id = $roleId;
        $this->username = $username;
        $this->billing_info_id = $billingId;
        $this->billingInfo = $billingInfo;
        $this->email = $email;
        $this->password = $password;
        $this->salt = $salt;
        $this->role_name = $roleName;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        return $vars;
    }
}
