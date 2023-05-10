<?php

// Define the namespace of this class
namespace Framework;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\databaseHandler;
use Framework\Model;
use Model\Account;

// Data Abstraction Object
// Interacts with the Databasehandler to set up a connection with the database
// Contains all the methods to interact with the database

abstract class DAO extends databaseHandler
{

    private $class;
    private $object;
    private $stmt;

    function __construct($class)
    {
        parent::__construct();
        $this->class = $class;
    }

    protected function startListSql($sql, $args = []): void
    {
        $this->stmt = $this->prepare($sql);
        $this->stmt->execute($args);
        $this->object = $this->stmt->fetchObject($this->class) ?: null;
    }

    // Returns an instance of the required class with property names that correspond to the column names or false on failure.
    protected function getObjectSql($sql, $args = []): ?Model
    {
        $this->stmt = $this->prepare($sql);
        $this->stmt->execute($args);
        return $this->stmt->fetchObject($this->class) ?: null;
    }

    // Returns true if $object is not null
    function hasNext(): bool
    {
        return $this->object !== null;
    }

    // fetches the next object then returns this object
    function getNext(): Model
    {
        $result = $this->object;
        $this->object = $this->stmt->fetchObject($this->class) ?: null;
        return $result;
    }

    function closeConnection(): void
    {
        $this->stmt->closeCursor();
    }
}
