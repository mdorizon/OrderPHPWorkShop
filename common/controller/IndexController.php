<?php
require_once './product/model/repository/ProductRepository.php';
require_once './product/model/entity/Product.php';
class IndexController {

	public function index() {
		$productRepository = new ProductRepository();
        $products = $productRepository->findAll();
        require_once './product/view/list-products.php';
	}
}