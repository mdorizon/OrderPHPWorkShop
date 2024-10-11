<?php
class Order {

    public static $CART_STATUS = 'CART';
    public static $SHIPPING_ADDRESS_SET_STATUS = 'SHIPPING_ADDRESS_SET';
    public static $SHIPPING_METHOD_SET_STATUS = 'SHIPPING_METHOD_SET';
    public static $PAID_STATUS = 'PAID';
    public static $MAX_PRODUCT_BY_ORDER = 5;
    public static $BLACKLISTED_CUSTOMERS = ["David Robert"];
    public static $UNIQUE_PRODUCT_PRICE = 5;
    public static $AUTORIZED_COUNTRIES = ["france", "belgique", "luxembourg"];
    public static $AVAILABLE_SHIPPING_METHODS = ["chronopost express", "point relais", "domicile"];
    public static $PAID_SHIPPING_METHODS = ["chronopost express"];
    public static $PAID_SHIPPING_METHODS_COST = 5;

    private int $id;
    private array $products;
    private float $totalPrice;
    private string $customerName;
    private datetime $createdAt;
    private string $status;
    private ?string $shippingMethod;
    private ?string $shippingCity;
    private ?string $shippingAddress;
    private ?string $shippingCountry;
    
    public function __construct(string $customerName, array $products = []) {
        // regex
        if (!preg_match('/^[a-zA-Z0-9\s-]{2,50}$/', $customerName)) {
            $success = null;
            $error = "Nom invalide";
            require_once './order/view/create-order.php';
            die;
        }

        $this->status = self::$CART_STATUS;
        $this->createdAt = new DateTime();
        $this->id = rand();

        if (count($products) > self::$MAX_PRODUCT_BY_ORDER) {
            $success = null;
            $error = "La commande ne peut excéder " . self::$MAX_PRODUCT_BY_ORDER ." articles !";
            require_once './order/view/create-order.php';
            die;
        }
        $this->products = $products;
        if (in_array($customerName, self::$BLACKLISTED_CUSTOMERS)) {
            $success = null;
            $error = "Vous êtes banni et ne pouvez commander !";
            require_once './order/view/create-order.php';
            die;
        }
        $this->customerName = $customerName;
        
        $this->totalPrice = $this->calculateTotalCart();
    }

    public function removeProduct(string $product): void {
        $this->removeProductFromList($product);
        $this->totalPrice = $this->calculateTotalCart();
    }

    public function removeProductFromList(string $product): void {
        if (($key = array_search($product, $this->products)) !== false) {
            unset($this->products[$key]);
        }
    }

    public function addProduct(Product $product): void {
        if (in_array($product, $this->products)) {
            throw new ErrorException("Cet article est déjà dans le panier !");
        }
        if (count($this->products) >= self::$MAX_PRODUCT_BY_ORDER) {
            throw new ErrorException("La commande ne peut excéder 5 articles !");
        }
        if ($this->status !== self::$CART_STATUS) {
            throw new ErrorException("Votre commande n'est pas en status CART !");
        }
        array_push($this->products, $product);

        $this->totalPrice = $this->calculateTotalCart();
    }

    public function setShippingAddress(string $address, string $city, string $country): void {
        //regex
        if (!preg_match('/^[a-zA-Z0-9\s-]{2,50}$/', $address)) {
            $success = null;
            $error = "Adresse invalide";
            require_once './order/view/set-shipping-address.php';
            die;
        }
        if (!preg_match('/^[a-zA-Z0-9\s-]{2,50}$/', $city)) {
            $success = null;
            $error = "Ville invalide";
            require_once './order/view/set-shipping-address.php';
            die;
        }
        if (!preg_match('/^[a-zA-Z0-9\s-]{2,50}$/', $country)) {
            $success = null;
            $error = "Pays invalide";
            require_once './order/view/set-shipping-address.php';
            die;
        }

        if ($this->status !== self::$CART_STATUS) {
            $success = null;
            $error = "Vous ne pouvez plus modifier l'adresse de livraison !";
            require_once './order/view/set-shipping-address.php';
            die;
        }
        if (!in_array(strtolower($country), self::$AUTORIZED_COUNTRIES)) {
            $success = null;
            $error = "Votre pays de livraison n'est pas disponible !";
            require_once './order/view/set-shipping-address.php';
            die;
        }
        $this->shippingAddress = $address;
        $this->shippingCity = $city;
        $this->shippingCountry = $country;
        
        $this->status = self::$SHIPPING_ADDRESS_SET_STATUS;
    }

    public function setShippingMethod(string $shippingMethod): void {
        if ($this->status !== self::$SHIPPING_ADDRESS_SET_STATUS) {
            $success = null;
            $error = "Vous devez d'abord saisir une adresse !";
            require_once './order/view/set-shipping-method.php';
            die;
        }
        if (!in_array(strtolower($shippingMethod), self::$AVAILABLE_SHIPPING_METHODS)) {
            $success = null;
            $error = "Votre méthode de livraison n'est pas valide !";
            require_once './order/view/set-shipping-method.php';
            die;
        }
        if(in_array(strtolower($shippingMethod), self::$PAID_SHIPPING_METHODS)) {
            $this->totalPrice = $this->calculateTotalCart() + self::$PAID_SHIPPING_METHODS_COST;
        }
        $this->shippingMethod = $shippingMethod;
        $this->status = self::$SHIPPING_METHOD_SET_STATUS;
    }

    public function payCart(): void {
        if ($this->status !== self::$SHIPPING_METHOD_SET_STATUS || $this->status !== self::$PAID_STATUS) {
            $success = null;
            $error = "Vous devez d'abord saisir une méthode de livraison !";
            require_once './order/view/pay.php';
            die;
        }
        $this->status = self::$PAID_STATUS;
    }

    public function getProducts(): array {
        return $this->products;
    }

    public function getCustomerName(): string {
        return $this->customerName;
    }
    
    public function getStatus(): string {
        return $this->status;
    }

    public function calculateTotalCart(): float {
        $total = 0;
        foreach($this->products as $product) {
            $total += $product->getPrice;
        }
        return $total;
    }
}