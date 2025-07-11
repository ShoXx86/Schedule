<?php


abstract class CrudModel {
    protected $id;

    static protected $sqlTable = '---notDefined---';



    public function __construct($id = null) {
        if ($id) {
            $this->id = $id;
            $this->read();
        }
    }

    
    abstract protected function getDatabaseArray();
    abstract protected function setDataFromDatabase($reader);

    
    public function create() {
        $data = $this->getDatabaseArray();
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));

        $sql = "INSERT INTO " . static::$sqlTable . " ($columns) VALUES ($placeholders)";
        $stmt = Database::getInstance()->getConnection()->prepare($sql);
        $stmt->execute(array_values($data));
        $this->id = Database::getInstance()->getConnection()->lastInsertId();
    }

    public function read() {
        $sql = "SELECT * FROM " . static::$sqlTable . " WHERE id = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($sql);
        $stmt->execute([$this->id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $this->setDataFromDatabase($result);
        } else {
            throw new Exception("Datensatz nicht gefunden.");
        }
    }

    public function update() {
        $data = $this->getDatabaseArray();
        $setPart = implode(", ", array_map(fn($key) => "$key = ?", array_keys($data)));

        $sql = "UPDATE " . static::$sqlTable . " SET $setPart WHERE id = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($sql);
        $stmt->execute(array_merge(array_values($data), [$this->id]));
    }

    public function delete() {
        $sql = "DELETE FROM " . static::$sqlTable . " WHERE id = ?";
        $stmt = Database::getInstance()->getConnection()->prepare($sql);
        $stmt->execute([$this->id]);
    }

}


?>