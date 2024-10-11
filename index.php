<?php

// Common
require_once './common/controller/IndexController.php';
// Order
require_once './order/controller/CreateOrderController.php';
require_once './order/controller/CartController.php';
require_once './order/controller/ShippingAddressController.php';
require_once './order/controller/ShippingMethodController.php';
require_once './order/controller/PayController.php';
// Product
require_once './product/controller/CreateProductController.php';

$requestUri = $_SERVER['REQUEST_URI'];
$uri = parse_url($requestUri, PHP_URL_PATH);
$endUri = str_replace('/workshopmethodo/', '', $uri);
$endUri = trim($endUri, '/');


if($endUri === "") {
    $indexController = new IndexController();
    $indexController->index();
    return;
} 

// ************//
//    Order    //
// ************//

if($endUri === "show-create-order") {
    $createOrderController = new CreateOrderController();
    $createOrderController->showCreateOrder();
    return;
} 
if($endUri === "create-order") {
    $createOrderController = new CreateOrderController();
    $createOrderController->createOrder();
    return;
}
if ($endUri === "shipping-address") {
    $shippingAddressController = new ShippingAddressController();
    $shippingAddressController->shippingAddress();
    return;
}
if ($endUri === "shipping-method") {
    $shippingMethodController = new ShippingMethodController();
    $shippingMethodController->shippingMethod();
    return;
}
if ($endUri === "payment") {
    $payController = new PayController();
    $payController->payment();
    return;
}
if ($endUri === "cart") {
    $cartController = new CartController();
    $cartController->showCart();
    return;
}
if ($endUri === "add-cart") {
    $cartController = new CartController();
    $cartController->addToCart();
    return;
}

// ************//
//   Products  //
// ************//

if ($endUri === "create-product") {
    $createProductController = new CreateProductController();
    $createProductController->CreateProduct();
    return;
}