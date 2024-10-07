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

        $this->products = $products;
        $this->customerName = $customerName;
        $this->totalPrice = count($products) * 5;

        echo "Commande {$this->id} créée !";
    }

    
}

$order = new Order('Jean Pierre', ['Casque', 'Téléphone']);