<?php

// Define the namespace of this class
namespace Framework;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Data\Secret;
use PDO;
use PDOException;

// Databasehandler class that handles the database connection

class databaseHandler
{

    private static $pdo = null;
    static $debug = false;

    function __construct()
    {
        if (self::$pdo === null) {
            $this->connect(Secret::DB_HOST, Secret::DB_NAME, Secret::DB_USERNAME, Secret::DB_PASSWORD);
        }
    }

    protected function connect($host, $dbname, $user, $pass): void
    {
        try {
            $dsn = "mysql:dbname=$dbname;host=$host;charset=utf8mb4";
            self::$pdo = new PDO($dsn, $user, $pass, null);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('SQLProvider connection failed: ' . $e->getMessage());
        }
    }

    function prepare($sql)
    {
        return self::$pdo->prepare($sql);
    }

    function execute($sql, $args = [])
    {
        $stmt = $this->prepare($sql);
        return $stmt->execute($args);
    }
}
