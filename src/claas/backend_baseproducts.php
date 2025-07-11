<?php
require_once(__DIR__ . '/../../App/Config/CrudModel.php');
require_once(__DIR__ . '/../../App/Config/dbcon.php');


class BaseProducts extends CrudModel
{
    protected static $sqlTable = 'backend_baseproducts';

    // Eigenschaften
    protected $id;
    protected $base_product;
    protected $base_price;
    protected $default_effect;
    protected $effect_id;
    protected $product_img;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function getDatabaseArray()
    {
        return [
            'base_product' => $this->base_product,
            'base_price' => $this->base_price,
            'default_effect' => $this->default_effect,
            'effect_id' => $this->effect_id,
            'product_img' => $this->product_img
        ];
    }

    protected function setDataFromDatabase($reader)
    {
        $this->base_product = $reader['base_product'];
        $this->base_price = $reader['base_price'];
        $this->default_effect = $reader['default_effect'];
        $this->effect_id = $reader['effect_id'];
        $this->product_img = $reader['product_img'];
    }

    // Getter
    public function getId()
    {
        return $this->id;
    }

    public function getBaseProduct()
    {
        return $this->base_product;
    }

    public function getBasePrice()
    {
        return $this->base_price;
    }

    public function getDefaultEffect()
    {
        return $this->default_effect;
    }

    public function getEffectId(): int
    {
        return (int)$this->effect_id;
    }


    public function getProductImg()
    {
        return $this->product_img;
    }

    // Setter
    public function setBaseProduct($value)
    {
        $this->base_product = $value;
    }

    public function setBasePrice($value)
    {
        $this->base_price = $value;
    }

    public function setDefaultEffect($value)
    {
        $this->default_effect = $value;
    }

    public function setEffectId($value)
    {
        $this->effect_id = $value;
    }


    public function setBaseProductImage($value)
    {
        $this->product_img = $value;
    }

    // Alle Produkte laden
    public static function GetAllBaseProducts()
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $products = [];
        foreach ($results as $row) {
            $product = new self($row['id']);
            $products[] = $product;
        }

        return $products;
    }

    // Produkt anhand des Namens finden
    public static function GetByBaseProductName($name)
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable . " WHERE base_product = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new self($row['id']) : null;
    }


    public static function GetByName(string $name): ?self
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id FROM backend_baseproducts WHERE base_product = ?");
        $stmt->execute([$name]);
        $row = $stmt->fetch();
        return $row ? new self($row['id']) : null;
    }


    // public static function GetByName(string $name): ?self
    // {
    //     $name = trim($name);
    //     $db = Database::getInstance()->getConnection();
    //     $stmt = $db->prepare("SELECT id FROM backend_baseproducts WHERE LOWER(base_product) = LOWER(?)");
    //     $stmt->execute([$name]);
    //     $row = $stmt->fetch();
    //     return $row ? new self($row['id']) : null;
    // }
}
