<?php 
require __DIR__ . '/../repositories/orderrepository.php';

class OrderService {

    public function startPayment($data, $orderId) {
        $repository = new OrderRepository();
        return $repository->startPayment($data, $orderId);
    }
    public function createOrder($method) {
        $repository = new OrderRepository();
        return $repository->createOrder($method);
    }
    public function createTickets($data) {
        $repository = new OrderRepository();
        return $repository->createTickets($data);
    }
    public function updatePayment($paymentId, $orderId) {
        $repository = new OrderRepository();
        return $repository->updatePayment($paymentId, $orderId);
    }
    public function checkPaymentStatus($orderId) {
        $repository = new OrderRepository();
        return $repository->checkPaymentStatus($orderId);
    }
    public function getPaidTickets($pay_id) {
        $repository = new OrderRepository();
        return $repository->getPaidTickets($pay_id);
    }
    public function removeTicketsFromEvents($tickets) {
        $repository = new OrderRepository();
        return $repository->removeTicketsFromEvents($tickets);
    }
    public function updatePaymentStatus($pay_id, $status) {
        $repository = new OrderRepository();
        return $repository->updatePaymentStatus($pay_id, $status);
    }
    public function deleteCreatedTickets($tickets) {
        $repository = new OrderRepository();
        return $repository->deleteCreatedTickets($tickets);
    }
}

