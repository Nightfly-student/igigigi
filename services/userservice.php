<?php
require __DIR__ . '/../repositories/userrepository.php';

class UserService {
    public function getAll() {
        $repository = new UserRepository();
        return $repository->getAll();
    }
    public function checkUserExist($username){
        $repository = new UserRepository();
        return $repository->checkUserExist($username);
    }
    public function checkUserEmailExist($username, $email){
        $repository = new UserRepository();
        return $repository->checkUserEmailExist($username, $email);
    }
    public function createUser($username, $email, $password){
        $repository = new UserRepository();
        return $repository->createUser($username, $email, $password);
    }
    public function checkLogin($username, $password){
        $repository = new UserRepository();
        return $repository->checkLogin($username, $password);
    }
    public function getSalt($username){
        $repository = new UserRepository();
        return $repository->getSalt($username);
    }
    public function getPassword($username){
        $repository = new UserRepository();
        return $repository->getPassword($username);
    }
    public function getRole($username){
        $repository = new UserRepository();
        return $repository->getRole($username);
    }
    public function changePassword($username, $password)
    {
        $repository = new UserRepository();
        return $repository->changePassword($username, $password);
    }
}