<?php

require_once '../model/Order.php'; 

session_start();

if (isset($_SESSION['order'])) {
    try {
        $address = $_POST['address'];
        $city    = $_POST['city'];
        $country = $_POST['country'];

        $order = $_SESSION['order'];
        $order->setShippingAddress($address, $city, $country);

        echo $order->listProducts();
    } catch (Exception $e) {
    
        require_once '../view/order-error.php';
    
    }	
} else {
    echo "Aucune commande en cours.";
}