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
    
    public function __construct(string $customerName, array $products) {
        // regex
        if (!preg_match('/^[a-zA-Z0-9\s-]{2,50}$/', $customerName)) {
            throw new ErrorException('Nom invalide');
        }
        if (!count($products) >= 1) {
            throw new ErrorException('Vous devez ajouter au moins un produit !');
        }
        // if (!preg_match('/^[a-zA-Z0-9\s-]{2,50}$/', $products)) {
        //     throw new ErrorException('Nom invalide');
        // }

        $this->status = Order::$CART_STATUS;
        $this->createdAt = new DateTime();
        $this->id = rand();

        if (count($products) > Order::$MAX_PRODUCT_BY_ORDER) {
            throw new ErrorException("La commande ne peut excéder " . Order::$MAX_PRODUCT_BY_ORDER ." articles !");
        }
        $this->products = $products;
        if (in_array($customerName, Order::$BLACKLISTED_CUSTOMERS)) {
            throw new ErrorException("Vous êtes banni et ne pouvez commander !");
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

    public function addProduct(string $product): void {
        if (in_array($product, $this->products)) {
            throw new ErrorException("Cet article est déjà dans le panier !");
        }
        if (count($this->products) >= Order::$MAX_PRODUCT_BY_ORDER) {
            throw new ErrorException("La commande ne peut excéder 5 articles !");
        }
        if ($this->status !== Order::$CART_STATUS) {
            throw new ErrorException("Votre commande n'est pas en status CART !");
        }
        array_push($this->products, $product);

        $this->totalPrice = $this->calculateTotalCart();
    }

    public function setShippingAddress(string $address, string $city, string $country): void {
        //regex
        if (!preg_match('/^[a-zA-Z0-9\s-]{2,50}$/', $address)) {
            throw new ErrorException('Adresse invalide');
        }
        if (!preg_match('/^[a-zA-Z0-9\s-]{2,50}$/', $city)) {
            throw new ErrorException('Ville invalide');
        }
        if (!preg_match('/^[a-zA-Z0-9\s-]{2,50}$/', $country)) {
            throw new ErrorException('Pays invalide');
        }

        if ($this->status !== Order::$CART_STATUS) {
            throw new ErrorException("Vous ne pouvez plus modifier l'adresse de livraison !");
        }
        if (!in_array(strtolower($country), Order::$AUTORIZED_COUNTRIES)) {
            throw new ErrorException("Votre pays de livraison n'est pas disponible !");
        }
        $this->shippingAddress = $address;
        $this->shippingCity = $city;
        $this->shippingCountry = $country;
        
        $this->status = Order::$SHIPPING_ADDRESS_SET_STATUS;
    }

    public function setShippingMethod(string $shippingMethod): void {
        if ($this->status !== Order::$SHIPPING_ADDRESS_SET_STATUS) {
            throw new ErrorException("Vous devez d'abord saisir une adresse !");
        }
        if (!in_array(strtolower($shippingMethod), Order::$AVAILABLE_SHIPPING_METHODS)) {
            throw new ErrorException("Votre méthode de livraison n'est pas valide !");
        }
        if(in_array(strtolower($shippingMethod), Order::$PAID_SHIPPING_METHODS)) {
            $this->totalPrice = $this->calculateTotalCart() + Order::$PAID_SHIPPING_METHODS_COST;
        }
        $this->shippingMethod = $shippingMethod;
        $this->status = Order::$SHIPPING_METHOD_SET_STATUS;
    }

    public function payCart(): void {
        if ($this->status !== Order::$SHIPPING_METHOD_SET_STATUS) {
            throw new ErrorException("Vous devez d'abord saisir une méthode de livraison !");
        }
        $this->status = Order::$PAID_STATUS;
    }

    public function getProducts(): array {
        return $this->products;
    }

    private function calculateTotalCart(): float {
        return count($this->products) * Order::$UNIQUE_PRODUCT_PRICE;
    }
}