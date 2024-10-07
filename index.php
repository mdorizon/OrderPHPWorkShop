<?php

class vendor_machine {
    private bool $is_on;
    private int $snacks_qty;
    private int $money;

    public function __construct() {
        $this->is_on = false;
        $this->snacks_qty = 50;
        $this->money = 0;
    }

    public function buySnack() {
        if (!$this->is_on) {
            throw new ErrorException("La machine est malheureusement éteinte :/");
        };
        if ($this->snacks_qty == 0) {
            throw new ErrorException("La machine n'as plus de snacks :/");
        };
        $this->snacks_qty -= 1;
        $this->money += 2;
    }

    public function reset() {
        $this->is_on = false;
        $this->money = 0;
        $this->snacks_qty += (50 - $this->snacks_qty);
        $this->is_on = true;
    }

    public function shoot_with_foot() {
        $this->is_on = false;

        $dropped_snacks = $this->drop_snacks();
        $dropped_money  = $this->drop_money();

        echo 'snacks tombés : ' . $dropped_snacks . ', argent tombé : ' . $dropped_money;
    }

    private function drop_money() {
        $money_to_drop = 20;
        if ($this->money < 20) {
            $money_to_drop = $this->money;
        }
        $this->money -= $money_to_drop;
        return $money_to_drop;
    }
    
    private function drop_snacks() {
        $snack_qty_to_drop = 5;
        if ($this->snacks_qty < 5) {
            $snack_qty_to_drop = $this->snacks_qty;
        }
        $this->snacks_qty -= $snack_qty_to_drop;
        return $snack_qty_to_drop;
    }
}

$vendor_machine_1 = new vendor_machine();
$vendor_machine_1->shoot_with_foot();
?>