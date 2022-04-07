<?php

require_once __DIR__ . '/Controller.php';

require __DIR__ . '/../services/ticketsservice.php';

class CartController extends Controller
{

	private $ticketsService;

	function __construct()
	{
		$this->ticketsService = new TicketsService();
	}

	function index()
	{
		if (isset($_SESSION['cart'])) {
			
			$arr = [];
			foreach ($_SESSION['cart'] as $key => &$val) {
				array_push($arr, (object)[
					'event_id' => $val['event'],
					'category' => $val['category'],
				]);
			}
			if (count($arr) !== 0) {
				$model = $this->ticketsService->getCart($arr);
			} else {
				$model = "empty";
			}
		} else {
			$model = "empty";
		}

		echo $this->displayView($model);
	}
}
