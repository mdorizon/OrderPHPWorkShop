<?php

require_once '../model/Order.php'; 

session_start();

if (isset($_SESSION['order'])) {
    $address = $_POST['address'];
	$city    = $_POST['city'];
	$country = $_POST['country'];

    $order = $_SESSION['order'];
	$order->setShippingAddress($address, $city, $country);

    echo $order->listProducts();
	
} else {
    echo "Aucune commande en cours.";
}