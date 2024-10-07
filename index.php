<?php

class VendorMachine {
    private bool $isOn;
    private int $snacksQty;
    private int $money;

    public function __construct() {
        $this->isOn = false;
        $this->snacksQty = 50;
        $this->money = 0;
    }

    public function buySnack(): void {
        if (!$this->isOn) {
            throw new ErrorException("La machine est malheureusement éteinte :/");
        };
        if ($this->snacksQty == 0) {
            throw new ErrorException("La machine n'as plus de snacks :/");
        };
        $this->snacksQty -= 1;
        $this->money += 2;
    }

    public function reset(): void {
        $this->isOn = false;
        $this->money = 0;
        $this->snacksQty += (50 - $this->snacksQty);
        $this->isOn = true;
    }

    public function shootWithFoot(): void {
        $this->isOn = false;

        $droppedSnacks = $this->dropSnacks();
        $droppedMoney  = $this->dropMoney();

        echo 'snacks tombés : ' . $droppedSnacks . ', argent tombé : ' . $droppedMoney;
    }

    private function dropMoney() {
        $moneyToDrop = 20;
        if ($this->money < 20) {
            $moneyToDrop = $this->money;
        }
        $this->money -= $moneyToDrop;
        return $moneyToDrop;
    }
    
    private function dropSnacks() {
        $snackQtyToDrop = 5;
        if ($this->snacksQty < 5) {
            $snackQtyToDrop = $this->snacksQty;
        }
        $this->snacksQty -= $snackQtyToDrop;
        return $snackQtyToDrop;
    }
}

$vendor_machine_1 = new VendorMachine();
$vendor_machine_1->shootWithFoot();

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

$order = new Order('Jean Pierre', ['Casque', 'Téléphone'])
?>