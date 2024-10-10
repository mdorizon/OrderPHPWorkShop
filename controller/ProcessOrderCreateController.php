<?php
require_once './model/entity/Order.php';
require_once './model/repository/OrderRepository.php';

class CreateOrderController {

	public function createOrder() {
		$orderRepository = new OrderRepository();

		try {
			if (!$this->isPostDataValid()) {
				$errorMessage = "Merci de remplir les champs. J'ai pas fait tout ça pour rien.";
				require_once './view/order-error.php';
				return;
			}

			$customerName = $_POST['customerName'];
			$products = $_POST['products'];
			
			$order = new Order($customerName, $products);

			$orderRepository->persist($order);

			require_once './view/order-created.php';

		} catch (Exception $e) {
			$errorMessage = $e->getMessage();
			require_once './view/order-error.php';
		}
	}
	private function isPostDataValid(): bool {
		return isset($_POST['customerName']) && isset($_POST['products']);
	}
}