<?php
require_once __DIR__ . '/Controller.php';
require __DIR__ . '/../services/userservice.php';
require_once __DIR__ . '/../helpers/recaptcha.php';
require_once __DIR__ . '/../helpers/salt.php';


class LoginController extends Controller{
        
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
                    $model = 'Username or Password is not set!';
                }
                else if($message == 'notexist'){
                    $model = 'Username or Password is not correct!';
                }
                else if($message == 'failedrecaptcha'){
                    $model = 'Please do the reCaptcha!';
                }
            }

            echo $this->displayView($model);
        }
        function login(){

            $recaptcha = $_POST['g-recaptcha-response'];
            $res = $this->recaptchaHelper->reCaptcha($recaptcha);
            if($res['success']){


                /*password or username is not set check*/
                if (empty($_POST['username']) || empty($_POST['pwd'])){
                    $message = "emptyinput";
                    header('Location: ' . '/login?message='. $message);
                }   
                else
                {

                    $datauser = [
                        'username' => trim($_POST['username']),
                        'pwd' => trim($_POST['pwd']),
                    ];

                    $checkexists = $this->userService->checkUserExist($datauser['username']);
                    
                    if($checkexists){
                        
                        $getpassword = $this->userService->getPassword($datauser['username']);
                        $passwordhashed = $getpassword[0]->getPassword();
                        $checkcorrect = password_verify($datauser['pwd'], $passwordhashed);

                        /*Login Succesfull check*/
                        if ($checkcorrect)
                        {
                            $getrole = $this->userService->getRole($datauser['username']);
                            $role = $getrole[0]->getRoleName();

                            $_SESSION['username'] = $datauser['username'];
                            $_SESSION['role'] = $role;

                            if ($_SESSION['role'] == 'volunteer' || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'superadmin'){
                                header('Location: ' . '/admin');
                            }
                            else{
                                header('Location: ' . '/dashboard');
                            }
                        }
                        /*password doesnt match username's password check*/
                        else{
                            $message = "notexist";
                            header('Location: ' . '/login?message='. $message);
                        }
                    }
                     /*Username is not found in the database check*/
                    else{
                        $message = "notexist";
                        header('Location: ' . '/login?message='. $message);
                    }
                }
            }
            /*Forgot recaptcha check*/
            else{
                $message = "failedrecaptcha";
                header('Location: ' . '/login?message='. $message);
            }
        }
        function logout()
        {
            logout();
            header('Location: ' . '/home');
        }

    
}
?>