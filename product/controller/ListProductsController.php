<?php

require_once './product/model/repository/ProductRepository.php';
require_once './product/model/entity/Product.php';

class ListProductsController {

    function listProducts() {
        $productRepository = new ProductRepository();
        $products = $productRepository->findAll();

        if (!$products) {
            require_once './order/view/404.php';
            return;
        }
        
        require_once './product/view/listProducts.php';
    }
}