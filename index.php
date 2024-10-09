<?php

require_once './controller/index.php';

$requestUri = $_SERVER['REQUEST_URI'];
$uri = parse_url($requestUri, PHP_URL_PATH);
$endUri = str_replace('/workshopmethodo/', '', $uri);
$endUri = trim($endUri, '/');


if($endUri === "") {

    $indexController = new IndexController();
    $indexController->index();

} 