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
        if ($this->status !== "CART") {
            throw new ErrorException("Votre commande n'est pas en status CART !");
        }
        array_push($this->products, $product);

        $this->countTotalPrice();
        $this->listProducts();
        echo " Total : " . $this->totalPrice . "€";
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

try {
    $order->addProduct('g');
} catch(Exception $error) {
    echo $error->getMessage();
}


// Choix de l'adresse de livraison
// règles métier :
// doit être en france, belgique ou luxembourg
// l'adresse de livraison ne peux pas être renseignée, si la commande n'est pas en statut "CART"

// Choix de la méthode de livraison
// règles métier :
// sélection parmi chronopost Express (+5e) , point relais et domicile
// la méthode de livraison ne peut pas être renseignée, si l'adresse n'est pas remplie
// Payer la commande
// règles métier :
// une commande ne peux pas être payée, si la méthode de livraison n'a pas eté remplie
// Status possibles : "CART", "SHIPPING_ADDRESS_SET", "SHIPPING_METHOD_SET"  et "PAID"