<?php
require_once './model/Order.php'; 

class ProcessPaymentController {

    function processPayment() {
        session_start();
        
        if (!isset($_SESSION['order'])) {
            require_once './view/404.php';
        }
        
        try {
            $order = $_SESSION['order'];
    
            $order->payCart();
            
            $_SESSION['order'] = $order;
    
            require_once './view/paid.php';
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once './view/order-error.php';
        }
    }
}
