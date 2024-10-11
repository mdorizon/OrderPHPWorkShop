<?php
require_once './order/model/entity/Order.php';
require_once './order/model/repository/OrderRepository.php';
class CreateOrderController {
    public function showCreateOrder() {
        require_once './order/view/create-order.php';
    }

    public function createOrder() {
		$orderRepository = new OrderRepository();
		try {
			$order = new Order($_POST['customerName']);
			$orderRepository->persist($order);
			require_once './order/view/order-created.php';

			header("Location: http://localhost:8888/workshopmethodo/");
		} catch (Exception $e) {
            $success = null;
            $error = $e->getMessage();
            require_once './order/view/create-order.php';
            die;
		}
        $orderRepository->persist($order);
	}
}
