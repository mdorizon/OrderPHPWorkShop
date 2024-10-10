<?php
require_once './model/entity/Order.php';
require_once './model/repository/OrderRepository.php';

class ProcessShippingAddressController {

    function processShippingAddress() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './view/404.php';
            return;
        }
        
        try {
            $shippingCountry = $_POST['shippingCountry'];
            $shippingCity = $_POST['shippingCity'];
            $shippingAdress = $_POST['shippingAdress'];
        
            $order->setShippingAddress($shippingAdress, $shippingCity, $shippingCountry);
        
            $orderRepository->persist($order);
        
            require_once './view/shipping-address-added.php';
        
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once './view/order-error.php';
        }
    }
}
