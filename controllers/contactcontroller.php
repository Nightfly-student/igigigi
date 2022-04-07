<?php
require_once __DIR__ . '/Controller.php';

    class ContactController extends Controller {
        public function index(){
            echo $this->displayViewOnly();
        }
    }