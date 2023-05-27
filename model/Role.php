<?php

// Define the namespace of this class
namespace Model;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once dirname(__FILE__) . '/../vendor/autoload.php';

// Import classes this class depends on
use Framework\Model;

// Role class with several methods to get it's own attribute values


class Role extends Model
{
    private int $roleID;
    private string $roleName;
    private string $roleDescription;

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
