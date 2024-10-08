<?php

require_once '../model/Order.php';

try {
    $order = new Order('Jean Pierre', ['Iphone', 'Chaise']);

    require_once '../view/order-created.php';

} catch (Exception $e) {

    require_once '../view/order-error.php';
    
}