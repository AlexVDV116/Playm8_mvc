<?php

require_once 'data/secret.php';

// Databasehandler class that opens up the database connection
class Dbh
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
            $dsn = "mysql:dbname=$dbname;host=$host;charset=utf8";
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
