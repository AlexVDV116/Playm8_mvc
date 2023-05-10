<?php

// Define the namespace of this class
namespace Model;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Model;

// Role class with several methods to get it's own attribute values


class Role extends Model
{
    public int $roleID;
    public string $roleName;
    public string $roleDescription;

    public function __construct(?array $data = null)
    {
        parent::__construct($data);
    }

    public function getRoleID(): int
    {
        return $this->roleID;
    }

    public function getRoleName(): string
    {
        return $this->roleName;
    }

    public function getRoleDescription(): string
    {
        return $this->roleDescription;
    }
}
