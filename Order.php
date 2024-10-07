<?php
class Order {
    private int $id;
    private array $products;
    private float $totalPrice;
    private string $customerName;
    private datetime $createdAt;
    private string $status;
    private ?string $shippingMethod;
    private ?string $shippingAddress;
    
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
        
        $this->totalPrice = count($products) * 5;
        
        echo "Commande {$this->id} créée !";
    }

    public function removeProduct($product) {
        if (in_array($product, $this->products)) {
            unset($this->products[array_search($product, $this->products)]);
        }
    }

    
}

try {
    $order = new Order('David Roberto', ['Casque', 'Téléphone', 'a', 'b', 'c']);
} catch(Exception $error) {
    echo $error->getMessage();
}

$order->removeProduct('Casque');