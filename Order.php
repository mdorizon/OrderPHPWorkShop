<?php
class Order {
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
        $this->status = "CART";
        $this->createdAt = new DateTime();
        $this->id = rand();

        if (count($products) > 5) {
            throw new ErrorException("La commande ne peut excéder 5 articles !");
        }
        $this->products = $products;
        if ($customerName == "David Robert") {
            throw new ErrorException("Vous êtes banni et ne pouvez commander !");
        }
        $this->customerName = $customerName;
        
        $this->countTotalPrice();
        
        echo "Commande {$this->id} créée !";
    }

    public function removeProduct(string $product): void {
        if (($key = array_search($product, $this->products)) !== false) {
            unset($this->products[$key]);
        }

        $this->listProducts();
    }

    public function addProduct(string $product): void {
        if (in_array($product, $this->products)) {
            throw new ErrorException("Cet article est déjà dans le panier !");
        }
        if (count($this->products) >= 5) {
            throw new ErrorException("La commande ne peut excéder 5 articles !");
        }
        if ($this->status !== "CART") {
            throw new ErrorException("Votre commande n'est pas en status CART !");
        }
        array_push($this->products, $product);

        $this->countTotalPrice();
        $this->listProducts();
        echo " Total : " . $this->totalPrice . "€";
    }

    public function setShippingAddress(string $address, string $city, string $country): void {
        if ($this->status !== "CART") {
            throw new ErrorException("Vous ne pouvez plus modifier l'adresse de livraison !");
        }
        if (!in_array(strtolower($country), ["france", "belgique", "luxembourg"])) {
            throw new ErrorException("Votre pays de livraison n'est pas disponible !");
        }
        $this->shippingAddress = $address;
        $this->shippingCity = $city;
        $this->shippingCountry = $country;
        
        $this->status = 'SHIPPING_ADDRESS_SET';
    }

    public function setShippingMethod(string $shippingMethod): void {
        if ($this->status !== "SHIPPING_ADDRESS_SET") {
            throw new ErrorException("Vous devez d'abord saisir une adresse !");
        }
        if (!in_array(strtolower($shippingMethod), ["chronopost express", "point relais", "domicile"])) {
            throw new ErrorException("Votre méthode de livraison n'est pas valide !");
        }
        if(strtolower($shippingMethod) == "chronopost express") {
            $this->totalPrice += 5;
        }
        $this->shippingMethod = $shippingMethod;
        $this->status = 'SHIPPING_METHOD_SET';
    }

    public function payCart(): void {
        if ($this->status !== "SHIPPING_METHOD_SET") {
            throw new ErrorException("Vous devez d'abord saisir une méthode de livraison !");
        }
        $this->status = "PAID";
        echo "Votre paiement à bien été effectué, votre commande est maintenant en status : " . $this->status;
    }

    public function listProducts(): void {
        $productAsString = implode(',', $this->products);
        echo "Liste des produits : {$productAsString}";
    }

    protected function countTotalPrice(): void {
        $this->totalPrice = count($this->products) * 5;
    }
}

try {
    $order = new Order('David Roberto', ['Casque', 'Téléphone', 'b', 'c']);
} catch(Exception $error) {
    echo $error->getMessage();
}

// $order->removeProduct('Casque');

try {
    $order->addProduct('g');
} catch(Exception $error) {
    echo $error->getMessage();
}

try {
    $order->setShippingAddress("test", "ville", "France");
} catch(Exception $error) {
    echo $error->getMessage();
}

try {
    $order->setShippingMethod("chronopost Express");
} catch(Exception $error) {
    echo $error->getMessage();
}

$order->payCart();