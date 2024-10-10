<?php
require_once './order/model/entity/Order.php';
require_once './order/model/repository/OrderRepository.php';

class ProcessShippingMethodController {

    function processShippingMethod() {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            require_once './order/view/404.php';
            return;
        }
        
        try {
            if (!$this->isPostDataValid()) {
                $errorMessage = "Merci de remplir les champs. J'ai pas fait tout ça pour rien.";
                
                require_once './order/view/order-error.php';
                return;
            }
        
            $shippingMethod = $_POST['shippingMethod'];
        
            $order->setShippingMethod($shippingMethod);
        
            $orderRepository->persist($order);
        
            require_once './order/view/shipping-method-added.php';
        
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once './order/view/order-error.php';
        }
    }

    private function isPostDataValid(): bool {
		return isset($_POST['shippingMethod']);
	}
}