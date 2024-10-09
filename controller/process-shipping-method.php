<?php

require_once '../model/Order.php'; 

session_start();

if (isset($_SESSION['order'])) {

    try {
        $order = $_SESSION['order'];

        $shippingMethod = $_POST['shippingMethod'];

        $order->setShippingMethod($shippingMethod);

        $_SESSION['order'] = $order;

        require_once '../view/shipping-method-added.php';

    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
        require_once '../view/order-error.php';
    }

} else {
	require_once '../view/404.php';
}
