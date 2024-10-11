<?php
require_once './product/model/entity/Product.php';
require_once './product/model/repository/ProductRepository.php';
class CreateProductController {

    public function CreateProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            $this->showForm();
        }
    }

    private function showForm() {
        require_once './product/view/create-product.php';
    }

    private function processForm() {
        try {
            $title = $_POST['title'];
            $price = ($_POST['price'] == "") ? null : $_POST['price'];
            $image = filter_var($_POST['image'], FILTER_VALIDATE_URL) ? $_POST['image'] : Product::$DEFAULT_IMAGE;
            $description = $_POST['description'];
            $isActive = isset($_POST['isActive']) ? true : false;

            $product = new Product($title, $image, $price, $description, $isActive);

            $productRepository = new ProductRepository();
            $productRepository->persist($product);

            $success = "Le produit a bien été créé !";
            $error = null;
            require_once './product/view/create-product.php';
        } catch (Exception $e) {
            $success = null;
            $error = $e->getMessage();
            require_once './product/view/create-product.php';
        }
    }
}