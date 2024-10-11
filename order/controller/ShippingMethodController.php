<?php
require_once './order/model/entity/Order.php';
require_once './order/model/repository/OrderRepository.php';

class ShippingMethodController {

    public function shippingMethod() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();
        if($order->getStatus() == "SHIPPING_METHOD_SET" || $order->getStatus() == "PAID") {
            header("Location: http://localhost:8888/workshopmethodo/payment");
            die;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processShippingMethod();
        } else {
            $this->setShippingMethod();
        }
    }

    function setShippingMethod() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }
        
        require_once './order/view/set-shipping-method.php';
    }

    function processShippingMethod() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }
        
        try {
            $shippingMethod = $_POST['shippingMethod'];
        
            $order->setShippingMethod($shippingMethod);
        
            $orderRepository->persist($order);
        
            header("Location: http://localhost:8888/workshopmethodo/shipping-method");
        
        } catch (Exception $e) {
            $success = null;
            $error = $e->getMessage();
            require_once './order/view/set-shipping-method.php';
            die;
        }
    }
}