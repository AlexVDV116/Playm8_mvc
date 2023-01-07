<?php

// Data Abstraction Object
// Interacts with the Databasehandler to set up a connection with the database
// Contains all the methods to interact with the database

require_once '../framework/databaseHandler.php';

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
}
