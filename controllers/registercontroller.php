<?php
require_once __DIR__ . '/Controller.php';

require __DIR__ . '/../services/userservice.php';
require_once __DIR__ . '/../helpers/recaptcha.php';
require_once __DIR__ . '/../helpers/salt.php';

class RegisterController extends Controller{
        
        private $userService;
        private $recaptchaHelper;
        private $saltHelper;

        function __construct()
        {
            $this->userService = new UserService();
            $this->recaptchaHelper = new Recaptcha();
            $this->saltHelper = new Salt();
        }
        function index(){

            $model = '';

            if (isset($_GET['message'])){
                $message = $_GET['message'];

                if ($message == 'emptyinput')
                {
                    $model = 'not all fields are filled!';
                }
                else if($message == 'alreadyexist'){
                    $model = 'Email is already taken!';
                }
                else if($message == 'failedrecaptcha'){
                    $model = 'Please do the reCaptcha!';
                }
                else if($message == 'passwordsfailed'){
                    $model = 'Passwords doesnt match!';
                }
            }

            echo $this->displayView($model);
        }
        function Register(){
            

            $recaptcha = $_POST['g-recaptcha-response'];
            $res = $this->recaptchaHelper->reCaptcha($recaptcha);
            if($res['success']){

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                /*Not all input fields are filled check*/
                if(empty($_POST['username']) || empty($_POST['email'])  || empty($_POST['pwd']) || empty($_POST['pwdRepeat']))
                {
                    $message = "emptyinput";
                    header('Location: ' . '/register?message='. $message);
                }
                else
                {
                    $datauser = [
                        'username' => trim($_POST['username']),
                        'email' => trim($_POST['email']),
                        'pwd' => trim($_POST['pwd']),
                        'pwdRepeat' => trim($_POST['pwdRepeat'])
                    ];

                    if ($datauser['pwd'] == $datauser['pwdRepeat'])
                    {
                        $count = $this->userService->checkUserEmailExist($datauser['username'], $datauser['email']);
                        /*user already exists check*/
                        if($count){
                            $message = "alreadyexist";
                            header('Location: ' . '/register?message='. $message);
                        }
                        /*registration succesfull check*/
                        else{

                            $hashedpassword = password_hash($datauser['pwd'], PASSWORD_DEFAULT);
                            $this->userService->createUser($datauser['username'], $datauser['email'], $hashedpassword);
    
                            $_SESSION['username'] = $datauser['username'];
                            $_SESSION['role'] = 'regular_user';
                        
                            header('Location: ' . '/dashboard');
                        }
                    }
                    /*passwords are no the same check*/
                    else{
                        $message = "passwordsfailed";
                        header('Location: ' . '/register?message='. $message);
                    }
                }
            }
            /*recaptcha not done check*/
            else{
                $message = "failedrecaptcha";
                header('Location: ' . '/register?message='. $message);
            }
        }
    
}