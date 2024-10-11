<?php
require_once './order/model/entity/Order.php';
require_once './order/model/repository/OrderRepository.php';

class ShippingAddressController {

    public function shippingAddress() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();
        
        if($order->getStatus() == "SHIPPING_ADDRESS_SET" || $order->getStatus() == "SHIPPING_METHOD_SET" || $order->getStatus() == "PAID") {
            header("Location: http://localhost:8888/workshopmethodo/shipping-method");
            die;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processShippingAddress();
        } else {
            $this->setShippingAddress();
        }
    }

    function setShippingAddress() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }
        
        require_once './order/view/set-shipping-address.php';
    }

    function processShippingAddress() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }
        
        try {
            $shippingCountry = $_POST['shippingCountry'];
            $shippingCity = $_POST['shippingCity'];
            $shippingAdress = $_POST['shippingAdress'];
        
            $order->setShippingAddress($shippingAdress, $shippingCity, $shippingCountry);
        
            $orderRepository->persist($order);
        
            header("Location: http://localhost:8888/workshopmethodo/shipping-method");
        
        } catch (Exception $e) {
            $success = null;
            $error = $e->getMessage();
            require_once './order/view/set-shipping-address.php';
            die;
        }
    }
}