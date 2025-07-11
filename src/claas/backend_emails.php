<?php
require_once(__DIR__ . '/../../App/Config/CrudModel.php');
require_once(__DIR__ . '/../../App/Config/dbcon.php');

class Email extends CrudModel
{
    protected static $sqlTable = 'backend_email';

    protected $id;
    protected $email;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    protected function getDatabaseArray(): array
    {
        return [
            'email' => $this->email
        ];
    }

    protected function setDataFromDatabase($reader): void
    {
        $this->email = $reader['email'];
    }

    // Getter
    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    // Setter
    public function setEmail(string $value): void
    {
        $this->email = $value;
    }

    // Alle Ränge abrufen
    public static function GetAllEmail(): array
    {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM " . static::$sqlTable);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $ranks = [];
        foreach ($rows as $row) {
            $ranks[] = new self($row['id']);
        }

        return $ranks;
    }

}
