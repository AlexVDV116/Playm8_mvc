<?php

// Define the namespace of this class
namespace Model;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Model;

// Permission class with several methods to get its own attribute values

class Permission extends Model
{
    public int $permissionID;
    public string $permissionName;
    public string $permissionDescription;

    public function __construct(?array $data = null)
    {
        parent::__construct($data);
    }

    public function getPermissionID(): int
    {
        return $this->permissionID;
    }

    public function getPermissionName(): string
    {
        return $this->permissionName;
    }

    public function getPermissionDescription(): string
    {
        return $this->permissionDescription;
    }
}
