<?php

// userProfile class with several methods to get it's own attributes

require_once '../framework/Model.php';

class userProfile extends Model
{
    private string $userProfileID;
    private string $firstName;
    private string $lastName;
    private string $location;
    private string $phoneNumber;
    private string $dateOfBirth;
    private string $age;

    public function __construct(?array $data = null)
    {
        parent::__construct($data);
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

    public function getLocation(): string
    {
        return $this->location;
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
}
