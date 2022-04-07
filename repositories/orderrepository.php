<?php

require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/ticket.php';

require_once __DIR__ . '/../helpers/initializeMollie.php';

class OrderRepository extends Repository
{
    function startPayment($data, $orderId)
    {
        try {
            $initialize = new initializeMollie;
            $mollie = $initialize->initialize();
            $redirectUrl = "https://haarlemfestival.herokuapp.com/order?orderId=" . $orderId;
            $payment = $mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $data['totalPrice'],
                ],
                "method" => $data['payment'],
                "description" => substr($data['description'], 0, 50),
                "redirectUrl" => $redirectUrl,
                "webhookUrl"  => "https://haarlemfestival.herokuapp.com/api/webhook",
                "metadata" => [
                    "order_id" => $orderId,
                ],
            ]);
            return $payment;
        } catch (PDOException $ec) {
            echo $ec;
        }
    }
    function createOrder($method)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO `payment` (status, payment_method_id, pay_id) VALUES(:status, (SELECT payment_method_id FROM payment_method WHERE method = :method), :pay_id) ");
            $stmt->execute(array(":status" => "open", ":pay_id" => 'Unknown', ":method" => $method));
            $payment_id = $this->connection->lastInsertId();
            //WHEN USERS CAN BE CREATED ADD USER INPUT//
            $stmt = $this->connection->prepare("INSERT INTO `orders` (users_id, payment_id) VALUES (:user, :payment_id)");
            $stmt->execute(array(":user" => 1, ":payment_id" => intval($payment_id)));
            $order_id = $this->connection->lastInsertId();
            return intval($order_id);
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function createTickets($data)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO `ticket` (`event_session_id`, `order_id`, `ticket_price`, `is_used`, `expireDate`, identifier) VALUES (:ses,:order,:price,:used,:expired, :identifier)");

            foreach ($data as $ticket) {
                $stmt->execute(array(':ses' => $ticket['event_session_id'], ':order' => $ticket['order_id'], ':price' => $ticket['ticket_price'], ':used' => $ticket['is_used'], ':expired' => $ticket['expireDate'], ':identifier' => md5(uniqid(time(), true))));
            }
            return true;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function removeTicketsFromEvents($tickets)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE `event_session` SET amount_available = amount_available - :people WHERE event_session_id = :eventId ");

            foreach ($tickets as $ticket) {
                $stmt->execute(array(':eventId' => $ticket['event_session_id'], ':people' => $ticket['persons']));
            }
            return true;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function deleteCreatedTickets($tickets) {
        $stmt = $this->connection->prepare("DELETE `ticket` as t WHERE t.ticket_id = :ticketId");

        foreach ($tickets as $ticket) {
            $stmt->execute(array(':ticketId' => $ticket->getId()));
        }
    }
    function updatePayment($paymentId, $orderId)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE `payment` as pay
            INNER JOIN `orders` as ord ON ord.payment_id = pay.payment_id
            SET pay.pay_id = :paymentId
            WHERE ord.order_id = :orderId");
            if ($stmt->execute(array(":paymentId" => $paymentId, ":orderId" => $orderId))) {
                return true;
            } else {
                return false;
            };
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function updatePaymentStatus($pay_id, $status)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE `payment` as pay SET pay.status = :payStatus WHERE pay.pay_id = :payId");
            if ($stmt->execute(array(":payStatus" => $status, ":payId" => $pay_id))) {
                return true;
            } else {
                return false;
            };
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function checkPaymentStatus($orderId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT pay.pay_id, pay.status FROM `payment` as pay
            INNER JOIN `orders`as ord ON ord.payment_id = pay.payment_id
            WHERE order_id = :orderId");
            $stmt->execute(array('orderId' => $orderId));
            $payment_id = $stmt->fetch(PDO::FETCH_ASSOC);

            $initialize = new initializeMollie;
            $mollie = $initialize->initialize();

            $payment = $mollie->payments->get($payment_id["pay_id"]);

            if ($payment->isPaid() && $payment_id['status'] != "paid") {
                $stmt = $this->connection->prepare("UPDATE `payment` as pay
                INNER JOIN `orders` as ord ON ord.payment_id = pay.payment_id
                SET pay.status = :status
                WHERE ord.order_id = :orderId");
                $stmt->execute(array('orderId' => $orderId, ':status' => 'paid'));
                return array('payment_id' => $payment_id["pay_id"], 'status' => 'paid');
            } else {
                return array('payment_id' => $payment_id["pay_id"], 'status' => $payment_id['status']);
            };
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getPaidTickets($pay_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT tik.* FROM `payment` as pay
            INNER JOIN `orders`as ord ON ord.payment_id = pay.payment_id
            INNER JOIN `ticket` as tik on tik.order_id = ord.order_id
            WHERE pay.pay_id = :pay_id");
            $stmt->execute(array(':pay_id' => $pay_id));
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Ticket');
            $tickets = $stmt->fetchAll();

            return $tickets;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getPayment($orderId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT pay.pay_id FROM `payment` as pay
            INNER JOIN `orders`as ord ON ord.payment_id = pay.payment_id
            WHERE order_id = :orderId");
            $stmt->execute(array('orderId' => $orderId));
            $payment_id = $stmt->fetch(PDO::FETCH_ASSOC);

            $initialize = new initializeMollie;
            $mollie = $initialize->initialize();

            $payment = $mollie->payments->get($payment_id["pay_id"]);

            return $payment;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
