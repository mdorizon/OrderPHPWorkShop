<?php
require_once './model/Order.php';

class CreateOrderController {

	public function createOrder() {
		session_start();

		try {
			if (!$this->isPostDataValid()) {
				$errorMessage = "Merci de remplir les champs. J'ai pas fait tout ça pour rien.";
				require_once './view/order-error.php';
				return;
			}

			$customerName = $_POST['customerName'];
			$products = $_POST['products'];
			
			$order = new Order($customerName, $products);

			$this->persistOrder($order);

			require_once './view/order-created.php';

		} catch (Exception $e) {
			$errorMessage = $e->getMessage();
			require_once './view/order-error.php';
		}
	}
	private function isPostDataValid(): bool {
		return isset($_POST['customerName']) && isset($_POST['products']);
	}

	private function persistOrder(Order $order): void {
		$_SESSION['order'] = $order;
	}
}