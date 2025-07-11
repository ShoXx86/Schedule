<?php
require_once(__DIR__ . '/../../App/Config/CrudModel.php');
require_once(__DIR__ . '/../../App/Config/dbcon.php');

class AllMixes extends CrudModel
{
    protected static $sqlTable = 'backend_allmixes';

    protected $id;
    protected $base_product;
    protected $cost;
    protected $sell;
    protected $profit;
    protected $substances;
    protected $effects;
    protected $rank;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function getDatabaseArray(): array
    {
        return [
            'base_product' => $this->base_product,
            'cost' => $this->cost,
            'sell' => $this->sell,
            'profit' => $this->profit,
            'substances' => $this->substances,
            'effects' => $this->effects,
            'rank' => $this->rank
        ];
    }

    protected function setDataFromDatabase($reader): void
    {
        $this->base_product = $reader['base_product'];
        $this->cost = $reader['cost'];
        $this->sell = $reader['sell'];
        $this->profit = $reader['profit'];
        $this->effects = $reader['effects'];
        $this->substances = $reader['substances'];
        $this->rank = $reader['rank'];
    }

    // Getter
    public function getId(): int
    {
        return $this->id;
    }

    public function getBaseProduct(): string
    {
        return $this->base_product;
    }

    public function getCost(): float
    {
        return (float)$this->cost;
    }

    public function getSell(): float
    {
        return (float)$this->sell;
    }

    public function getProfit(): float
    {
        return (float)$this->profit;
    }


    public function getSubstances(): array
    {
        return json_decode($this->substances, true);
    }

    public function getEffects(): string
    {
        return $this->effects;
    }

    public function getRank(): string
    {
        return $this->rank;
    }

    // Setter
    public function setBaseProduct(string $value): void
    {
        $this->base_product = $value;
    }

    public function setCost(float $value): void
    {
        $this->cost = $value;
    }

    public function setSell(float $value): void
    {
        $this->sell = $value;
    }

    public function setProfit($value): void
    {
        $this->profit = $value;
    }


    public function setRank(string $value): void
    {
        $this->rank = $value;
    }

    public function setSubstances(array $list): void
    {
        $this->substances = json_encode($list);
    }

    public function setEffects(array $list): void
    {
        $this->effects = json_encode($list);
    }


    public static function CreateFromData(array $data): void
    {
        $mix = new self();
        $mix->setBaseProduct($data['base_product']);
        $mix->setCost($data['cost']);
        $mix->setSell($data['sell']);
        $mix->setRank($data['rank']);
        $mix->setEffects($data['effects']);
        $mix->setSubstances($data['substances']);
        $mix->setProfit($data['profit']);
        $mix->create();
    }


    public static function GetAll(): array
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new self($row['id']), $rows);
    }

    public static function GetFirstMixes(int $limit = 6): array
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable . " LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new self($row['id']), $rows);
    }

    public static function Search($term, $limit = 25): array
    {
        $conn = Database::getInstance()->getConnection();
        $like = '%' . $term . '%';
        $sql = "SELECT id FROM " . static::$sqlTable . " 
        WHERE base_product LIKE :like
           OR substances LIKE :like
           OR effects LIKE :like
           OR rank LIKE :like
        LIMIT :limit";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':like', $like);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new self($row['id']), $rows);
    }

    public static function GetTopNByBaseProduct(string $baseProduct, int $n = 50): array
    {
        $conn = Database::getInstance()->getConnection();
        $sql = "SELECT id FROM " . static::$sqlTable . "
            WHERE base_product = :bp
            ORDER BY profit DESC
            LIMIT :n";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':bp', $baseProduct);
        $stmt->bindValue(':n', $n, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new self($row['id']), $rows);
    }

    public function getProfitMargin(): float
    {
        $sell = $this->getSell();
        $profit = $this->getProfit();
        if ($sell > 0) {
            return round(($profit / $sell) * 100, 2);
        }
        return 0.0;
    }

    public static function GetTopProfitMixesByBaseProduct(array $data): array
    {
        $conn = Database::getInstance()->getConnection();
        $result = [];

        $sql = "
        SELECT id FROM " . static::$sqlTable . "
        WHERE base_product = :base_product
        ORDER BY profit DESC
        LIMIT 1
    ";
        $stmt = $conn->prepare($sql);

        foreach ($data as $baseProductName) {
            $stmt->bindValue(':base_product', $baseProductName);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $result[$baseProductName] = new self($row['id']);
            }
        }

        return $result;
    }
}
