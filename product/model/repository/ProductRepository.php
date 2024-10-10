<?php 

require_once './product/model/entity/Product.php';

class ProductRepository {

    public function __construct() {
        session_start();
        if (!isset($_SESSION['products'])) {
            $_SESSION['products'] = [];
        }
    }

    public function persist(Product $product): Product {
        $_SESSION['products'][] = $product;
        return $product;
    }

    public function findAll(): array {
        return $_SESSION['products'];
    }
}