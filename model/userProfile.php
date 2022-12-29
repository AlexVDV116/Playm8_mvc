<?php

class userProfile
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
}
