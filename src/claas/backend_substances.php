
<?php
require_once(__DIR__ . '/../../App/Config/CrudModel.php');
require_once(__DIR__ . '/../../App/Config/dbcon.php');

class Substances extends CrudModel
{
    protected static $sqlTable = 'backend_substances';

    // Eigenschaften
    protected $id;
    protected $substances;
    protected $substancecost;
    protected $effectid;
    protected $rank_id;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function getDatabaseArray()
    {
        return [
            'substances' => $this->substances,
            'substancecost' => $this->substancecost,
            'effectid' => $this->effectid,
            'rank_id' => $this->rank_id
        ];
    }

    protected function setDataFromDatabase($reader)
    {
        $this->substances = $reader['substances'];
        $this->substancecost = $reader['substancecost'];
        $this->effectid = $reader['effectId'];
        $this->rank_id = $reader['rank_id'];
    }

    // Getter
    public function getId()
    {
        return $this->id;
    }

    public function getSubstance()
    {
        return $this->substances;
    }

        public function getSubstanceCost()
    {
        return $this->substancecost;
    }

    public function getEffectId()
    {
        return $this->effectid;
    }

    public function getRankId()
    {
        return $this->rank_id;
    }

    // Setter
    public function setSubstance($substances)
    {
        $this->substances = $substances;
    }

    public function setEffectId($effectid)
    {
        $this->effectid = $effectid;
    }
    public function setSubstanceCost($substancecost)
    {
        $this->substancecost = $substancecost;
    }
    public function setRankId($rank_id)
    {
        $this->rank_id = $rank_id;
    }

    // Alle Substances laden
    public static function GetAllSubstances()
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $substancesArray = [];
        foreach ($results as $row) {
            $substance = new self($row['id']);
            $substancesArray[] = $substance;
        }

        return $substancesArray;
    }

    public static function GetByEffectId(int $effectId): ?self
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable . " WHERE effectId = :effectId LIMIT 1");
        $stmt->bindParam(':effectId', $effectId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new self($result['id']) : null;
    }
}
?>
