<?php
require_once __DIR__ . '/Controller.php';
require __DIR__ . '/../services/ticketsservice.php';

class TicketsController extends Controller
{

	private $ticketsService;

	function __construct()
	{
		$this->ticketsService = new TicketsService();
	}

	function index()
	{
		$model = $this->ticketsService->getAll();
		usort($model, function($a, $b) {
			return date_format(date_create($a->getDate()), 'Y-m-d H:i:s') <=> date_format(date_create($b->getDate()), 'Y-m-d H:i:s') ;
		});
		echo $this->displayView($model);	
	}
}
