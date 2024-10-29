<?php
namespace app\cars;

use lib\Database;

class model {
    private Database $db;

    public function __construct() {
        $this->db = new Database(); // Verbindung zur m295-Datenbank herstellen
    }

    public function getData(string $sql, array $params = []): array {
        $stmt = $this->db->conn->prepare($sql); // SQL-Abfrage vorbereiten
        foreach ($params as $key => &$value) {
            $stmt->bindParam($key, $value); // Parameter binden
        }
        $stmt->execute(); // Abfrage ausführen
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Ergebnisse als Array zurückgeben
    }
}
