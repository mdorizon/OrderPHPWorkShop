<?php

class SetShippingAddressController {

    function setShippingAddress() {
        session_start();
        
        if (!isset($_SESSION['order'])) {
            require_once './view/404.php';
            return;
        }
        
        require_once './view/set-shipping-address.php';
    }
}