<?php
require_once(__DIR__ . '/../../App/Config/CrudModel.php');
require_once(__DIR__ . '/../../App/Config/dbcon.php');
require_once(__DIR__ . '/backend_ranks.php'); // für getRank()

class EffectMultipliers extends CrudModel
{
    protected static $sqlTable = 'backend_effectmultipliers';

    protected $id;
    protected $effect_name; // ✅ HINZUFÜGEN
    protected $multiplier;
    protected $effect_cost;
    protected $rank_id;


    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function getDatabaseArray(): array
    {
        return [
            'id' => $this->id,
            'effect_name' => $this->effect_name,
            'multiplier' => $this->multiplier,
            'effect_cost' => $this->effect_cost,
            'rank_id' => $this->rank_id
        ];
    }

    protected function setDataFromDatabase($reader): void
    {
        $this->id = $reader['id'];
        $this->effect_name = $reader['effect_name'];
        $this->multiplier = $reader['multiplier'];
        $this->effect_cost = $reader['effect_cost'];
        $this->rank_id = $reader['rank_id'] ?? null;
    }

    // Getter
    public function getId(): int
    {
        return $this->id;
    }

    public function getEffectName(): string
    {
        return $this->effect_name ?? '';
    }

    public function getMultiplier(): float
    {
        return (float)$this->multiplier;
    }

    public function getEffectCost(): float
    {
        return (float)$this->effect_cost;
    }

    public function getRankId(): ?int
    {
        return $this->rank_id;
    }

    public function getRank(): ?Rank
    {
        return $this->rank_id ? new Rank($this->rank_id) : null;
    }

    // Setter
    public function setEffectName(string $effect_name): void
    {
        $this->effect_name = $effect_name;
    }

    public function setMultiplier(float $multiplier): void
    {
        $this->multiplier = $multiplier;
    }

    public function setEffectCost(float $effect_cost): void
    {
        $this->effect_cost = $effect_cost;
    }

    public function setRankId(int $rank_id): void
    {
        $this->rank_id = $rank_id;
    }

    // Alle Multipliers laden
    public static function GetAllEffects(): array
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT * FROM " . static::$sqlTable); // <--- WICHTIG!
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $multipliers = [];
        foreach ($results as $row) {
            $multiplier = new self();
            $multiplier->setDataFromDatabase($row); // <-- das lädt alle Felder
            $multipliers[] = $multiplier;
        }

        return $multipliers;
    }


    public static function GetByEffectName(string $name): ?self
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable . " WHERE effect_name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new self($row['id']) : null;
    }
}
