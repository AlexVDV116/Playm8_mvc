<?php

// Define the namespace of this class
namespace Model;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once dirname(__FILE__) . '/../vendor/autoload.php';

// Import classes this class depends on
use Framework\Model;

// Permission class with several methods to get its own attribute values

class Permission extends Model
{
    private int $permissionID;
    private string $permissionName;
    private string $permissionDescription;

    public function __construct(?array $data = null)
    {
        parent::__construct($data);
    }

    public function get(mixed $attribute): mixed
    {
        return $this->$attribute;
    }

    public function set(mixed $attribute, $value): void
    {
        $this->$attribute = $value;
    }

    public function getAllAttributes(): array
    {
        return get_object_vars($this);
    }
}
