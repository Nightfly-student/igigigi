<?php

require_once __DIR__ . '/Controller.php';
require __DIR__ . '/../services/ticketsservice.php';
require __DIR__ . '/../services/orderservice.php';

ob_start();

class CheckoutController extends Controller
{
	private $ticketsService;
	private $orderService;

	function __construct()
	{
		if (!isset($_SESSION['cart'])) {
			header('Location: /tickets');
			return;
		}
		if (count($_SESSION['cart']) === 0) {
			header('Location: /tickets');
			return;
		}

		$this->ticketsService = new TicketsService();
		$this->orderService = new OrderService();
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

			$model = $this->ticketsService->getCart($arr);
		}

		$data = [
			'fname' => '',
			'lname' => '',
			'mail' => '',
			'bday' => '',
			'phone' => '',
			'country' => '',
			'province' => '',
			'street' => '',
			'number' => '',
			'payment' => '',
			'fnameError' => '',
			'totalCost' => 0,
		];
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$data = [
				'fname' => trim($_POST['fname']),
				'lname' => trim($_POST['lname']),
				'mail' => trim($_POST['mail']),
				'bday' => trim($_POST['bday']),
				'phone' => trim($_POST['phone']),
				'country' => trim($_POST['country']),
				'province' => trim($_POST['province']),
				'street' => trim($_POST['street']),
				'number' => trim($_POST['house']),
				'payment' => trim($_POST['payment']),
				'totalPrice' => trim($_POST['totalPrice']),
				'description' => trim($_POST['description'])
			];

			$createOrder = $this->orderService->createOrder($data['payment']);
			$startPayment = $this->orderService->startPayment($data, $createOrder);
			$tickets = [];
			foreach ($_SESSION['cart'] as $value) {
				foreach ($model as $item) {
					if ($item->getId() === $value['event']) {
						$ticketprice = $item->getPrice();
						$expireDate = new DateTime($item->getDate());
						$minutes = intval(date('i', strtotime($item->getDuration())));
						$hours = intval(date('h', strtotime($item->getDuration())));
						$expireDate->modify("+{$minutes} minutes");
						$expireDate->modify("+{$hours} hours");
						$category = $item->getCategory();
					}
				}
				if ($category != 'food') {
					for ($i = 0; $i < ($value['children'] + $value['adults']); $i++) {
						array_push($tickets, [
							'event_session_id' => $value['event'],
							'order_id' => $createOrder,
							'ticket_price' => $ticketprice,
							'is_used' => false,
							'expireDate' => $expireDate->format('Y-m-d H:i:s'),
						]);
					}
				} else {
					array_push($tickets, [
						'event_session_id' => $value['event'],
						'order_id' => $createOrder,
						'ticket_price' => ($ticketprice * ($value['children'] + $value['adults'])),
						'is_used' => false,
						'expireDate' => $expireDate->format('Y-m-d H:i:s'),
					]);
				}
			}
			if ($this->orderService->updatePayment($startPayment->id, $createOrder)) {

				if ($this->orderService->createTickets($tickets)) {
					unset($_SESSION['cart']);
					header("Location: " . $startPayment->getCheckoutUrl(), true, 303);
				};
			};
		}

		echo $this->displayView($model);
	}
}
