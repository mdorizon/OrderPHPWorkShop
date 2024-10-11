<?php
require_once './product/model/entity/Product.php';
require_once './product/model/repository/ProductRepository.php';

class ProcessCreateProductController {

	public function createProduct() {
		try {
			$title = $_POST['title'];
			$price = $_POST['price'];
			$description = $_POST['description'];
			$isActive = $_POST['isActive'] ?? false;
			
			$product = new Product($title, $price, $description, $isActive);

			$productRepository = new ProductRepository();
            $productRepository->persist($product);

			require_once './product/view/product-created.php';

		} catch (Exception $e) {
			$errorMessage = $e->getMessage();
			require_once './product/view/product-error.php';
		}
	}
}