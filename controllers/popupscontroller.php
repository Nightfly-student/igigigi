<?php
require_once __DIR__ . '/Controller.php';
class PopupsController extends Controller {
    function index(){
		$model = "Welkom bij het Haarlem Festival";
		echo $this->displayView($model);
	}
}
?>