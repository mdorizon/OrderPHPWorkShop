<?php 

class Product {
    public static $DEFAULT_PRICE = 2;
    public static $MIN_PRICE = 1;
    public static $MAX_PRICE = 500;
    public static $MIN_TITLE_LENGTH = 3;
    public static $MAX_TITLE_LENGTH = 100;
    public static $DEFAULT_IMAGE = "https://img.freepik.com/vecteurs-libre/salle-conference-vide_529539-71.jpg";
    private string $id;
    private string $title;
    private float $price;
    private string $description;
    private string $image;
    private bool $isActive;
    private DateTime $createdAt;

    public function __construct(string $title, string $image = null, float $price = null, string $description = '', bool $isActive = false) {
        // verify $title
        if (!preg_match('/^[a-zA-Z0-9\s-]{3,100}$/', $title)) {
            $success = null;
			$error = "Veuillez entrer un titre correct !";

			require_once './product/view/create-product.php';
            die;
        }
        // verify $price
        $price ??= self::$DEFAULT_PRICE;
        if ($price < self::$MIN_PRICE || $price > self::$MAX_PRICE ) {
            $success = null;
			$error = "Le prix doit être entre " . self::$MIN_PRICE . "€ et " . self::$MAX_PRICE . "€ !";

			require_once './product/view/create-product.php';
            die;
        }
        $image ??= self::$DEFAULT_IMAGE;
        
        $this->title = $title;
        $this->image = $image;
        $this->price = $price;
        $this->description = $description;
        $this->isActive = $isActive;

        // à changer quand on utilisera une BDD
        $this->createdAt = new DateTime();
        $this->id = uniqid();
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