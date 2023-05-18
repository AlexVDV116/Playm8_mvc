<?php

// Define the namespace of this class
namespace Model;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Model;

// userProfile class with several methods to get it's own attribute values

class userProfile extends Model
{
    private string $accountID;
    private string $userProfileID;
    private string $firstName;
    private string $lastName;
    private string $city;
    private string $country;
    private string $phoneNumber;
    private string $dateOfBirth;
    private string $age;
    private string $aboutMeTitle;
    private string $aboutMeText;
    private string $userProfilePicture;

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
}
