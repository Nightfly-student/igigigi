<?php
require __DIR__ . '/../../services/ticketsservice.php';
require __DIR__ . '/../../services/orderservice.php';
require __DIR__ . '/../../services/documentservice.php';

require_once __DIR__ . '/../../helpers/initializeMollie.php';

class WebhookController
{
    private $ticketsService;
    private $orderService;
    private $documentService;

    function __construct()
    {
        $this->orderService = new OrderService();
        $this->ticketsService = new TicketsService();
        $this->documentService = new DocumentService();
    }

    public function index()
    {
        if (isset($_POST["id"])) {
            try {

                $initialize = new initializeMollie;
                $mollie = $initialize->initialize();

                $payment = $mollie->payments->get($_POST["id"]);

                if ($this->orderService->updatePaymentStatus($payment->id, $payment->status)) {
                    if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {

                        $tickets = $this->orderService->getPaidTickets($payment->id);
                        $this->documentService->sendOrder($tickets);

                    } elseif ($payment->isPending()) {

                        $tickets = $this->orderService->getPaidTickets($payment->id);
                        $ticketArray = [];
                        foreach ($tickets as $ticket) {
                            $event = $this->ticketsService->getEvent($ticket->getSession());

                            if ($event[0]->getCategory() != 'food') {
                                foreach ($ticketArray as $key => $item) {
                                    if ($item["event_session_id"] == $ticket->getSession()) {
                                        $ticketArray[$key]['persons'] += 1;
                                    }
                                }
                                array_push($ticketArray, [
                                    "event_session_id" => $ticket->getSession(),
                                    "persons" => 1,
                                ]);
                            } else {
                                array_push($ticketArray, [
                                    "event_session_id" => $ticket->getSession(),
                                    "persons" => intval($ticket->getPrice() / $event[0]->getPrice()),
                                ]);
                            }
                        }
                        $this->orderService->removeTicketsFromEvents($ticketArray);
                    } elseif ($payment->isFailed()) {

                        $tickets = $this->orderService->getPaidTickets($payment->id);
                        $ticketArray = [];
                        foreach ($tickets as $ticket) {
                            $event = $this->ticketsService->getEvent($ticket->getSession());

                            if ($event[0]->getCategory() != 'food') {
                                foreach ($ticketArray as $key => $item) {
                                    if ($item["event_session_id"] == $ticket->getSession()) {
                                        $ticketArray[$key]['persons'] += 1;
                                    }
                                }
                                array_push($ticketArray, [
                                    "event_session_id" => $ticket->getSession(),
                                    "persons" => 1,
                                ]);
                            } else {
                                array_push($ticketArray, [
                                    "event_session_id" => $ticket->getSession(),
                                    "persons" => intval($ticket->getPrice() / $event[0]->getPrice()),
                                ]);
                            }
                        }
                        $this->orderService->deleteCreatedTickets($tickets);
                        $this->ticketsService->updateAmountAvailable($ticketArray);
                    }
                };
            } catch (\Mollie\Api\Exceptions\ApiException $e) {
                echo "API call failed: " . htmlspecialchars($e->getMessage());
            }
        } else {
            echo json_encode("Webhook url");
        }
    }
}
