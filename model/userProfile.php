<?php

class userProfile extends Model
{
    private string $userProfileID;
    private string $firstName;
    private string $lastName;
    private string $location;
    private string $phoneNumber;
    private string $dateOfBirth;
    private string $age;

    public function __construct($userProfileID, $firstName,  $lastName, $location, $phoneNumber, $dateOfBirth, $age)
    {
        $this->userProfileID = $userProfileID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->location = $location;
        $this->phoneNumber = $phoneNumber;
        $this->dateOfBirth = $dateOfBirth;
        $this->age = $age;
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
