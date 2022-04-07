<?php

require_once __DIR__ . '/Controller.php';

class HomeController extends Controller {
    function index(){
		$model = "Welkom bij het Haarlem Festival";
		echo $this->displayView($model);
	}
}
?>