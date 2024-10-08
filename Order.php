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

        $this->shippingAddress = "";
        
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
        if ($this->status !== "CART") {
            throw new ErrorException("Votre commande n'est pas en status CART !");
        }
        array_push($this->products, $product);

        $this->countTotalPrice();
        $this->listProducts();
        echo " Total : " . $this->totalPrice . "€";
    }

    public function addressChoice($address, $city, $country): void {
        if (!in_array(strtolower($country), ["france", "belgique", "luxembourg"])) {
            throw new ErrorException("Votre pays de livraison n'est pas disponible !");
        }
        if ($this->status !== "CART") {
            throw new ErrorException("Votre commande n'est pas en status CART !");
        }
        $this->shippingAddress = $address;
        $this->shippingCity = $city;
        $this->shippingCountry = $country;
    }

    public function shippingMethodChoice($shippingMethod): void {
        if($this->shippingAddress == "") {
            throw new ErrorException("Vous devez d'abord saisir une adresse.");
        }
        if($shippingMethod == "chronopost Express") {
            $this->totalPrice += 5;
        }
        $this->shippingMethod = $shippingMethod;
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
    $order = new Order('David Roberto', ['Casque', 'Téléphone', 'a', 'b', 'c']);
} catch(Exception $error) {
    echo $error->getMessage();
}

// $order->removeProduct('Casque');

// try {
//     $order->addProduct('g');
// } catch(Exception $error) {
//     echo $error->getMessage();
// }

try {
    $order->addressChoice("test", "ville", "France");
} catch(Exception $error) {
    echo $error->getMessage();
}

try {
    $order->shippingMethodChoice("chronopost Express");
} catch(Exception $error) {
    echo $error->getMessage();
}

// Payer la commande
// règles métier :
// une commande ne peux pas être payée, si la méthode de livraison n'a pas eté remplie
// Status possibles : "CART", "SHIPPING_ADDRESS_SET", "SHIPPING_METHOD_SET"  et "PAID"