<?php
require_once(__DIR__ . '/../../App/Config/CrudModel.php');
require_once(__DIR__ . '/../../App/Config/dbcon.php');

class Replaces extends CrudModel
{
    protected static $sqlTable = 'backend_replaces';

    protected $id;
    protected $replaceFrom;
    protected $replaceTo;
    protected $effektId;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function getDatabaseArray()
    {
        return [
            'replace_from' => $this->replaceFrom,
            'replace_to' => $this->replaceTo,
            'effektId' => $this->effektId
        ];
    }

    protected function setDataFromDatabase($reader)
    {
        $this->replaceFrom = $reader['replaceFrom'];
        $this->replaceTo = $reader['replaceTo'];
        $this->effektId = $reader['effektId'];
    }

    // Getter
    public function getReplaceFrom()
    {
        return $this->replaceFrom;
    }

    public function getReplaceTo()
    {
        return $this->replaceTo;
    }

    public function getEffektId()
    {
        return $this->effektId;
    }

    public function getId()
    {
        return $this->id;
    }

    // Setter
    public function setReplaceFrom($value)
    {
        $this->replaceFrom = $value;
    }

    public function setReplaceTo($value)
    {
        $this->replaceTo = $value;
    }

    public function setEffektId($value)
    {
        $this->replaceTo = $value;
    }

    // Static: get all
    public static function GetAllReplaces()
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $items = [];
        foreach ($results as $row) {
            $items[] = new self($row['id']);
        }

        return $items;
    }

    public static function GetReplacesByEffectId($effectId)
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable . " WHERE effektId = ?");
        $stmt->execute([$effectId]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $items = [];
        foreach ($results as $row) {
            $items[] = new self($row['id']);
        }

        return $items;
    }
}
