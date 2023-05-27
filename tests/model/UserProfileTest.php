<?php

use Model\userProfile;
use PHPUnit\Framework\TestCase;

require_once '../Playm8_mvc/model/userProfile.php';

final class UserProfileTest extends TestCase
{

    public function testGet(): void
    {
        // Associative array which contains the data used to instantiate the userProfile class
        $testData = array(
            "accountID" => "testAccountID",
            "userProfileID" => "testUserProfileID",
            "firstName" => "testFirstName",
            "lastName" => "testLastName",
            "city" => "testCity",
            "country" => "testCountry",
            "phoneNumber" => "testPhoneNumber",
            "age" => "testAge",
            "aboutMeTitle" => "testAboutMeTitle",
            "aboutMeText" => "testAboutMeText",
            "userProfilePicture" => "testUserProfilePicture"
        );

        // Instantiate a new userProfile with the testData as its attribute values
        $userProfile = new userProfile($testData);

        // Use the userProfile method getAllAttributes to get an associative array containing the object attributes and values
        // Iterate over the object atributes and their values and
        // for each attribute, use the userProfile get method on that key to get the attribute value, then compare both values
        foreach ($userProfile->getAllAttributes() as $attr => $value) {
            $this->assertEquals($value, $userProfile->get($attr));
        }
    }

    public function testSet(): void
    {
        // Associative array which contains the data used to instantiate the userProfile class
        $testData = array(
            "accountID" => "testAccountID",
            "userProfileID" => "testUserProfileID",
            "firstName" => "testFirstName",
            "lastName" => "testLastName",
            "city" => "testCity",
            "country" => "testCountry",
            "phoneNumber" => "testPhoneNumber",
            "age" => "testAge",
            "aboutMeTitle" => "testAboutMeTitle",
            "aboutMeText" => "testAboutMeText",
            "userProfilePicture" => "testUserProfilePicture"
        );

        // Instantiate a new userProfile with the testData as its attribute values
        $userProfile = new userProfile($testData);

        // For each object attribute as the key in the userProfile object, use the userProfile set method on that key to change the attribute value
        foreach ($userProfile->getAllAttributes() as $key => $value) {
            $userProfile->set($key, "newTest" . ucfirst($key));
            $this->assertEquals("newTest" . ucfirst($key), $userProfile->get($key));
        }
    }

    public function testGetAllAttributes(): void
    {
        // Associative array which contains the data used to instantiate the Permission class
        $testData = array(
            "accountID" => "testAccountID",
            "userProfileID" => "testUserProfileID",
            "firstName" => "testFirstName",
            "lastName" => "testLastName",
            "city" => "testCity",
            "country" => "testCountry",
            "phoneNumber" => "testPhoneNumber",
            "age" => "testAge",
            "aboutMeTitle" => "testAboutMeTitle",
            "aboutMeText" => "testAboutMeText",
            "userProfilePicture" => "testUserProfilePicture"
        );

        // Instantiate a new Account with the testData as its attribute values
        $account = new userProfile($testData);

        // Call the getAllAttribbutes method on a variable and check if the method returns an array 
        $attributes = $account->getAllAttributes();
        $this->assertIsArray($attributes);

        // Iterate over each key in the testData associative array
        // and check if that key exists in the array returned by the getAllAttributes method
        foreach ($testData as $key => $value) {
            $this->assertArrayHasKey($key, $attributes);
        }
    }
}
