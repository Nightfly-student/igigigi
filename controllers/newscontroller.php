<?php
require_once __DIR__ . '/Controller.php';

require __DIR__ . '/../services/newsservice.php';

class NewsController extends Controller{
        
        private $newsService;

        function __construct()
        {
            $this->newsService = new NewsService();
        }
        function insertEmail()
        {
            $action=$_POST['submit']; 
            if ($action=='submit')
            {
            $email = $_POST['email'];
            $this->newsService->insertEmail($email);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    
}