<?php

// Define the namespace of this class
namespace Framework;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Data\secret;
use PDO;
use PDOException;

// Databasehandler class that handles the database connection

class databaseHandler
{

    private static $pdo = null;
    static $debug = false;

    public function __construct()
    {
        if (self::$pdo === null) {
            $this->connect(secret::DB_HOST, secret::DB_NAME, secret::DB_USERNAME, secret::DB_PASSWORD);
        }
    }

    protected function connect(string $host, string $dbname, string $user, string $pass): void
    {
        try {
            $dsn = "mysql:dbname=$dbname;host=$host;charset=utf8mb4";
            self::$pdo = new PDO($dsn, $user, $pass, null);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('SQLProvider connection failed: ' . $e->getMessage());
        }
    }

    public function prepare(string $sql)
    {
        return self::$pdo->prepare($sql);
    }

    public function execute(string $sql, array $args = [])
    {
        $stmt = $this->prepare($sql);
        return $stmt->execute($args);
    }

    // Function that returns an array containing all database tables
    public function getAllTables(): array
    {
        $stmt = $this->prepare("SHOW tables");
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    // Function that returns an array containing all collumns in a table
    // IMPORTANT: Change database name to match webhost/localhost database name
    public function getAllCollumns($table): array
    {
        $stmt = $this->prepare("SELECT COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = 'playm8' AND TABLE_NAME = ?;");
        $stmt->execute([$table]);
        $result = $stmt->fetchAll();

        return $result;
    }
}
