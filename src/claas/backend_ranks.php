<?php
require_once(__DIR__ . '/../../App/Config/CrudModel.php');
require_once(__DIR__ . '/../../App/Config/dbcon.php');

class Rank extends CrudModel
{
    protected static $sqlTable = 'backend_ranks';

    protected $id;
    protected $rank_name;
    protected $rank_level;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function getDatabaseArray(): array
    {
        return [
            'rank_name' => $this->rank_name,
            'rank_level' => $this->rank_level
        ];
    }

    protected function setDataFromDatabase($reader): void
    {
        $this->rank_name = $reader['rank_name'];
        $this->rank_level = (int)$reader['rank_level'];
    }

    // Getter
    public function getId(): int
    {
        return $this->id;
    }

    public function getRankName(): string
    {
        return $this->rank_name;
    }

    public function getRankLevel(): int
    {
        return $this->rank_level;
    }

    // Setter
    public function setRankName(string $value): void
    {
        $this->rank_name = $value;
    }

    public function setRankLevel(int $value): void
    {
        $this->rank_level = $value;
    }

    // Alle Ränge abrufen
    public static function GetAllRanks(): array
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable . " ORDER BY rank_level ASC");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ranks = [];
        foreach ($rows as $row) {
            $ranks[] = new self($row['id']);
        }

        return $ranks;
    }

    public static function GetByRankName(string $name): ?self
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable . " WHERE rank_name = ?");
        $stmt->execute([$name]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? new self($row['id']) : null;
    }
}
