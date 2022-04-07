<?php
require_once __DIR__ . '/Controller.php';

require __DIR__ . '/../services/userservice.php';
require __DIR__ . '/../services/dashboardservice.php';

class DashboardController extends Controller
{        
    private $dashboardService;
    private $userService;

    function __construct()
    {
        $this->dashboardService = new DashboardService();
        $this->userService = new UserService();
    }
    function index(){
        $model = $this->dashboardService->getProfile($_SESSION['username']);
        echo $this->displayView($model);
    }  

    //validate email
    function changeemail() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_VALIDATE_EMAIL);
        $datauser = [
            'email' => trim($_POST['email'])
        ];
        if(!filter_var($datauser['email'], FILTER_VALIDATE_EMAIL)){
        }
        else {
            //sends email to repository to be edited in database
            $model = $this->dashboardService->changeEmail($_SESSION['username'], $datauser);    
            //redirects back to dashboard        
            header("Location: /dashboard");
            exit();
        }        
    }

    //validate password
    function changePassword() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if(empty($_POST['pwdCurrent']) || empty($_POST['pwdNew']) || empty($_POST['pwdNewR']) && $_POST['pwdNew'] !=  $_POST['pwdNewR']) {
            echo 'One or more input fields are empty or password are not the same';
        }
        else {
            $datauser = [
                'password' => trim($_POST['pwdCurrent']),
                'passwordNew' => trim($_POST['pwdNew']),
                'passwordNewRepeat' => trim($_POST['pwdNewR'])
            ];

            $getpassword = $this->userService->getPassword($_SESSION['username']);
            $passwordhashed = $getpassword[0]->getPassword();
            $checkcorrect = password_verify($datauser['password'], $passwordhashed);

            $hashednewpassword = password_hash($datauser['passwordNew'], PASSWORD_DEFAULT);

            echo $this->userService->changePassword($_SESSION['username'], $hashednewpassword);
        }
    }

    //validate profile
    function saveprofile() {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $datauser = [
            'firstname' => trim($_POST['firstname']),
            'lastname' => trim($_POST['lastname']),
            'address' => trim($_POST['address']),
            'country' => trim($_POST['country']),
            'phonenumber' => trim($_POST['phonenumber'])
        ];
        if(empty($datauser['firstname']) || empty($datauser['lastname']) || empty($datauser['address']) || empty($datauser['country']) || empty($datauser['phonenumber'])) {
           return 'One or more input fields are empty.';
        }
        else {
            //sends new data to update user data to database billing_info
            $model = $this->dashboardService->saveProfile($_SESSION['username'], $datauser);
            //redirects back to dashboard        
            header("Location: /dashboard");
            exit();
        }
    }
}