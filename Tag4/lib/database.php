<?php
namespace lib;

use Exception;
use PDO;
use PDOException;

/**
 * Class `database` manages database connections and queries.
 */
class database {
    /**
     * @var PDO|null $pdo The PDO database connection.
     */
    private ?PDO $pdo = null;

    /**
     * @var \PDOStatement|null $stmt The prepared PDO statement.
     */
    private ?\PDOStatement $stmt = null;

    /**
     * Constructor of the `database` class.
     *
     * Establishes a connection to the database, creating it if it doesn't exist.
     *
     * @throws PDOException If the connection fails.
     */
    public function __construct() {
        $host = 'localhost';
        $db = 'm295';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        
        try {
            // Connect to MySQL server without specifying the database
            $dsn = "mysql:host=$host;charset=$charset";
            $this->pdo = new PDO($dsn, $user, $pass);  // Assign to class property

            // Check if the database exists, create if not
            if (!$this->databaseExists($db, $this->pdo)) {
                $this->createDatabase($db, $this->pdo);
            }

            // Now connect to the specific database
            $dsnWithDb = "mysql:host=$host;dbname=$db;charset=$charset";
            $this->pdo = new PDO($dsnWithDb, $user, $pass);
        } catch (PDOException $e) {
            throw new PDOException("Database connection failed: " . $e->getMessage(), (int)$e->getCode());
        }
    }

    /**
     * Checks if the database exists.
     *
     * @param string $dbName The name of the database.
     * @param PDO $pdo The PDO instance for the database connection.
     * @return bool True if the database exists, false otherwise.
     */
    private function databaseExists(string $dbName, PDO $pdo): bool {
        $query = $pdo->prepare("SHOW DATABASES LIKE ?");
        $query->execute([$dbName]);
        return $query->fetch() !== false;
    }

    /**
     * Creates the database by executing the SQL file.
     *
     * @param string $dbName The name of the database.
     * @param PDO $pdo The PDO instance for the database connection.
     * @throws Exception If an error occurs while creating the database.
     */
    private function createDatabase(string $dbName, PDO $pdo): void {
        // Create the database
        $result = $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName`");
        if ($result === false) {
            throw new Exception("Fehler beim Erstellen der Datenbank: $dbName");
        }
        
        // Select the new database
        $pdo->exec("USE `$dbName`");

        // Load and execute the SQL file to set up the tables and schema
        $sqlFilePath = __DIR__ . '/../databases/database.sql';
        if (file_exists($sqlFilePath)) {
            $sql = file_get_contents($sqlFilePath);
            $pdo->exec($sql);
        } else {
            throw new Exception("SQL file for database setup not found at $sqlFilePath");
            $pdo = '';
        }
    }

    /**
     * Executes an SQL query and returns the result set.
     *
     * @param string $sql  The SQL query to be executed.
     * @param array<string|int, mixed> $data The parameters for the SQL query.
     * @return array<int, array<string, mixed>> The result set as an associative array.
     * @throws Exception If an error occurs during query execution.
     */
    public function executeQuery(string $sql, array $data = []): array {
        if ($this->pdo === null) {
            throw new Exception("Database connection is not established.");
        }

        try {
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($data);
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error executing query: " . $e->getMessage());
        }
    }

    /**
     * Destructor of the `database` class.
     *
     * Closes the database connection.
     */
    public function __destruct() {
        $this->pdo = null; // Clean up the PDO connection
    }
}
