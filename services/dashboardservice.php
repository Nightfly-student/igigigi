<?php
require __DIR__ . '/../repositories/dashboardrepository.php';


class DashboardService 
{
    // get profile details of logged in user //
    public function getProfile($username) {
        $repository = new DashboardRepository();
        return $repository->getProfile($username);
    }
    // updates user profile of logged in user //
    public function saveProfile($username, $datauser){
        $repository = new DashboardRepository();
        return $repository->saveProfile($username, $datauser);
    }
    // changes email of logged in user //
    public function changeEmail($username, $datauser){
        $repository = new DashboardRepository();
        return $repository->changeEmail($username, $datauser);
    }
    // changes password of logged in user //
    public function changePassword($username, $datauser){
        $repository = new DashboardRepository();
        return $repository->changePassword($username, $datauser);
    }
}