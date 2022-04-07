<?php

require_once __DIR__ . '/Controller.php';

require __DIR__ . '/../services/orderservice.php';
require __DIR__ . '/../services/documentservice.php';

class OrderController extends Controller
{
    private $orderService;
    private $documentService;

    function __construct()
    {
        $this->orderService = new OrderService();
        $this->documentService = new DocumentService();
    }

    function index()
    {

        if (isset($_GET['orderId'])) {
            $status = $this->orderService->checkPaymentStatus($_GET['orderId']);
            if($status['status'] === "paid") {
                $tickets = $this->orderService->getPaidTickets($status['payment_id']);         
            } else {
                echo $this->displayView('Order not paid yet');
            }
            if(isset($_POST['createPDF'])) {
                $this->documentService->createPDF($tickets);
            }
            if(isset($_POST['createInvoice'])) {
                $this->documentService->createInvoice($tickets);
            }
            echo $this->displayView($tickets);
    
        } else {
            echo $this->displayViewOnly();
        }
    }
}
