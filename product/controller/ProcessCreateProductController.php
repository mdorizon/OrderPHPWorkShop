<?php
require_once './product/model/entity/Product.php';
require_once './product/model/repository/ProductRepository.php';

class ProcessCreateProductController {

	public function createProduct() {
		try {
			$title = $_POST['title'];
			$price = ($_POST['price'] == "") ? null : $_POST['price'];
			$image = filter_var($_POST['image'], FILTER_VALIDATE_URL) ? $_POST['image'] : Product::$DEFAULT_IMAGE;
			$description = $_POST['description'];
			$isActive = $_POST['isActive'] ?? false;
			
			$product = new Product($title, $image, $price, $description, $isActive);

			$productRepository = new ProductRepository();
            $productRepository->persist($product);

			require_once './product/view/product-created.php';

		} catch (Exception $e) {
			$errorMessage = $e->getMessage();
			require_once './product/view/product-error.php';
		}
	}
}