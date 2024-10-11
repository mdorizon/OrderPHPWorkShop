<?php
require_once './product/model/entity/Product.php';
require_once './product/model/repository/ProductRepository.php';
class CartController {

	public function showCart(): void {
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();
        $productsInCart = $order->getProducts();
		require_once './order/view/cart.php';
	}

    public function addToCart() {
        if (!isset($_GET['id'])) {
            $errorMessage = "ID de produit non spécifié!";
            require_once './order/view/order-error.php';
        }
        $productRepository = new ProductRepository();
        $product = $productRepository->findById($_GET['id']);
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find();

        if (!$order) {
            header('Location: http://localhost:8888/workshopmethodo/show-create-order');
            return;
        }
        
        $order->addProduct($product);
        
        header('Location: http://localhost:8888/workshopmethodo/cart');
    }
}