<?php

// Define the namespace of this class
namespace Model;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Model;

// userProfile class with several methods to get it's own attribute values

class userProfile extends Model
{
    public string $accountID;
    public string $userProfileID;
    public string $firstName;
    public string $lastName;
    public string $city;
    public string $country;
    public string $phoneNumber;
    public string $dateOfBirth;
    public string $age;
    public string $aboutMeTitle;
    public string $aboutMeText;
    public string $userProfilePicture;

    public function __construct(?array $data = null)
    {
        parent::__construct($data);
    }

    public function getAccountID(): string
    {
        return $this->accountID;
    }

    public function getUserProfileID(): string
    {
        return $this->userProfileID;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getDateOfBirth(): string
    {
        return $this->dateOfBirth;
    }

    public function getAge(): string
    {
        return $this->age;
    }

    public function getAboutMeTitle(): string
    {
        return $this->aboutMeTitle;
    }

    public function getAboutMeText(): string
    {
        return $this->aboutMeText;
    }

    public function getUserProfilePicture(): string
    {
        return $this->userProfilePicture;
    }
}
