<?php
require_once './model/Order.php'; 

class ProcessShippingAddressController {

    function processShippingAddress() {
        session_start();
        
        if (!isset($_SESSION['order'])) {
            require_once './view/404.php';
            return;
        }
        
        try {
            $order = $_SESSION['order'];
        
            $shippingCountry = $_POST['shippingCountry'];
            $shippingCity = $_POST['shippingCity'];
            $shippingAdress = $_POST['shippingAdress'];
        
            $order->setShippingAddress($shippingAdress, $shippingCity, $shippingCountry);
        
            $_SESSION['order'] = $order;
        
            require_once './view/shipping-address-added.php';
        
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once './view/order-error.php';
        }
    }
}
