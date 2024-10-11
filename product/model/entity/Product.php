<?php 

class Product {
    public static $DEFAULT_PRICE = 2.0;
    public static $DEFAULT_IMAGE = "https://img.freepik.com/vecteurs-libre/salle-conference-vide_529539-71.jpg";
    private int $id;
    private string $title;
    private float $price;
    private string $description;
    private string $image;
    private bool $isActive;
    private DateTime $createdAt;

    public function __construct(string $title, string $image = null, float $price = null, string $description = '', bool $isActive = false) {
        // verify $title
        if (!preg_match('/^[a-zA-Z0-9\s-]{3,100}$/', $title)) {
            header('Location: http://localhost:8888/workshopmethodo/create-product?&error=Veuillez entrer un titre correct !');
            die;
        }
        // verify $price
        $price ??= Product::$DEFAULT_PRICE;
        if ($price < 1.0 || $price > 500.0 ) {
            header('Location: http://localhost:8888/workshopmethodo/create-product?&error=Le prix doit être entre 1€ et 500€ !');
            die;
        }
        $image ??= Product::$DEFAULT_IMAGE;
        
        $this->title = $title;
        $this->image = $image;
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

    public function getPrice(): float {
        return $this->price;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function getIsActive(): bool {
        return $this->isActive;
    }
}