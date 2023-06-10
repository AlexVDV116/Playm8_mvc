<?php

// Define the namespace of this class
namespace DAO;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\DAO;

// Data Abstraction Object for a Role object
// Can access the database create, read, update, or delete data (CRUD) on the roles table

class csvDAO extends DAO
{
    public function __construct()
    {
        parent::__construct(NULL);
    }

    public function getAllTables(): array
    {
        $stmt = $this->prepare("SHOW tables");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();

        return $result;
    }
}
