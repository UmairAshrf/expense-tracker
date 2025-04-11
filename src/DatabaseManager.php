<?php 
namespace ExpenseTracker;

use PDO;
use PDOException;
use Dotenv;
/**
 * Manages database connections and initializes the Expense Tracker application's database.
 *
 * This class is responsible for setting up the database connection using environment variables,
 * creating the database if it does not exist, and initializing the required table structures.
 * It also provides a method for executing SQL queries against the database.
 *
 */

class DatabaseManager {

    /**
     * @var PDO Holds the PDO connection object used throughout the class for database operations.
     */
    protected $pdo;

    /**
     * Constructor initializes the database connection and sets up the database and tables.
     */

    public function __construct() {
        $this->connect();
        $this->initializeDatabase();
    }

    /**
     * Establishes a PDO connection to the database using credentials loaded from environment variables.
     *
     * @throws PDOException If there is an error connecting to the database.
     */

    private function connect() {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            $this->pdo = new PDO("mysql:host=$host", $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB ERROR: " . $e->getMessage());
        }
    }

    /**
     * Creates the database if it does not exist and sets up the required table structure.
     */
    private function initializeDatabase() {
        $dbname = $_ENV['DB_NAME'];
        $this->pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
        $this->pdo->exec("use $dbname");
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS expenses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            amount DECIMAL(10,2) NOT NULL,
            category VARCHAR(50) NOT NULL,
            date DATE NOT NULL,
            description TEXT
        )");
    }

    /**
     * Executes a SQL query using the provided SQL string and parameters.
     *
     * @param string $sql The SQL query string.
     * @param array $params An array of parameters for the SQL query placeholders.
     * @return PDOStatement The PDO statement object after execution.
     */

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}

