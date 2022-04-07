<?php
require __DIR__ . '/../repositories/adminuserrepository.php';

class AdminUserService{
    private $userDao;

    function __construct(){
        $this->userDao = new AdminUserRepository();
    }

    public function getAllUsers(){
        $users = $this->userDao->getAllUsers();
        $bills = $this->getBillingInformation();
        $users = $this->addBillingInformationToUser($users, $bills);
        return $users; 
    }
    public function getBillingInformation(){
        $bills = $this->userDao->getBillingInformation();
        return $bills;
    }
    public function getRoles(){
        return $this->userDao->getRoles();
    }

    public function addBillingInformationToUser($users, $billing_info){
        foreach($users as $user){
            foreach($billing_info as $bill){
                if($user->getBillingId() == $bill->getId()){
                    $user->setBillingInfo($bill);
                }
            }
        }
        return $users;
    }

    public function createUser($user){
        return $this->userDao->createUser($user);
    }
    public function deleteUser($id){
        return $this->userDao->deleteUser($id);
    }

    public function checkIfUserExists($id){
        return $this->userDao->checkIfUserExists($id);
    }

    public function getUserById($id){
        return $this->userDao->getUserById($id);
    }

    public function checkIfUsernameIsTaken($username){
        return $this->userDao->checkIfUsernameIsTaken($username);
    }

    public function updateUser($user){
        return $this->userDao->updateUser($user);
    }
    
    public function checkIfEmailIsTaken($email){
        return $this->userDao->checkIfEmailIsTaken($email);
    }
}