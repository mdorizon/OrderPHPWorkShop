<?php
require_once './model/Order.php'; 

class ProcessShippingMethodController {

    function processShippingMethod() {
        session_start();
        
        if (!isset($_SESSION['order'])) {
            require_once './view/404.php';
            return;
        }
        
        try {
            $order = $_SESSION['order'];
        
            if (!$this->isPostDataValid()) {
                $errorMessage = "Merci de remplir les champs. J'ai pas fait tout ça pour rien.";
                
                require_once './view/order-error.php';
                return;
            }
        
            $shippingMethod = $_POST['shippingMethod'];
        
            $order->setShippingMethod($shippingMethod);
        
            $_SESSION['order'] = $order;
        
            require_once './view/shipping-method-added.php';
        
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once './view/order-error.php';
        }
    }

    private function isPostDataValid(): bool {
		return isset($_POST['shippingMethod']);
	}
}