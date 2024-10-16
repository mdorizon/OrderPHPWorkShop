<?php
require_once './order/model/entity/Order.php';
require_once './order/model/repository/OrderRepository.php';

class PayController {

    public function payment() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();
        $productsInCart = $order->getProducts();
        if($order->getStatus() == "PAID") {
            require_once './order/view/paid.php';
            die;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processPayment();
        } else {
            $this->pay();
        }
    }

    public function pay() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }
        
        require_once './order/view/pay.php';
    }

    function processPayment() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();
        if (!$order) {
            require_once './order/view/404.php';
            return;
        }
        
        try {
            $order->payCart();
            $orderRepository->persist($order);
            require_once './order/view/paid.php';
        } catch (Exception $e) {
            $success = null;
            $error = $e->getMessage();
            require_once './order/view/pay.php';
            die;
        }
    }
}