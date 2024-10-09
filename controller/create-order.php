<?php

require_once '../model/Order.php';

session_start();

try {

	if (!isPostDataValid()) {
		$errorMessage = "Merci de remplir les champs. J'ai pas fait tout ça pour rien.";
		
		require_once '../view/order-error.php';
		return;
	}

	$customerName = $_POST['customerName'];
	$products = $_POST['products'];

	$order = new Order($customerName, $products);

	persistOrder($order);

	require_once '../view/order-created.php';

} catch (Exception $e) {
	$errorMessage = $e->getMessage();
	require_once '../view/order-error.php';
}

function isPostDataValid(): bool {
	return isset($_POST['customerName']) && isset($_POST['products']);
}

function persistOrder(Order $order): void {
	$_SESSION['order'] = $order;
}