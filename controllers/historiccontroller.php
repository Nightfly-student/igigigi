<?php
require_once __DIR__ . '/Controller.php';

require __DIR__ . '/../services/historicservice.php';

class HistoricController extends Controller {

	private $histroicService;

	function __construct()
	{
		$this->historicService = new HistoricService();
	}

    function index(){

		$model = $this->historicService->getAll();
		echo $this->displayView($model);
	}
}
?>