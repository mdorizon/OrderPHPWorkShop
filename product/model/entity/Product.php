<?php 

class Product {
    public static $DEFAULT_PRICE = 2;
    private int $id;
    private string $title;
    private float $price;
    private string $description;
    private bool $isActive;
    private DateTime $createdAt;

    public function __construct(string $title, float $price = null, string $description = '', bool $isActive = false) {
        // verify $title
        if (!preg_match('/^[a-zA-Z0-9\s-]{3,100}$/', $title)) {
            throw new ErrorException('Titre invalide !');
        }
        // verify $price
        if ($price < 1 || $price > 500 ) {
            throw new ErrorException('Le prix doit être entre 1€ et 500€ !');
        }
        $this->price = $price ?? Product::$DEFAULT_PRICE;
        
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
        $this->isActive = $isActive;

        // à changer quand on utilisera une BDD
        $this->createdAt = new DateTime();
        $this->id = rand();
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getPrice(): string {
        return $this->price;
    }

    public function getIsActive(): bool {
        return $this->isActive;
    }
}