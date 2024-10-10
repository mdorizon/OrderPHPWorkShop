<?php
require_once './model/entity/Order.php';
require_once './model/repository/OrderRepository.php';

class ProcessShippingMethodController {

    function processShippingMethod() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './view/404.php';
            return;
        }
        
        try {
            if (!$this->isPostDataValid()) {
                $errorMessage = "Merci de remplir les champs. J'ai pas fait tout ça pour rien.";
                
                require_once './view/order-error.php';
                return;
            }
        
            $shippingMethod = $_POST['shippingMethod'];
        
            $order->setShippingMethod($shippingMethod);
        
            $orderRepository->persist($order);
        
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