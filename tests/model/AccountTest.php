<?php

use Model\Account;
use PHPUnit\Framework\TestCase;

require_once '../Playm8_mvc/model/Account.php';

final class AccountTest extends TestCase
{

    /**
     * @covers \Account::__construct
     */
    public function testClassConstructor(): void
    {
        // Associative array which contains the data used to instantiate the Account class
        $testData = array(
            "accountID" => "testAccountID",
            "username" => "testUserName",
            "email" => "testEmail",
            "password" => "testPassword",
            "isBetaUser" => false,
            "isActive" => false,
            "activationCode" => "testActivationCode",
            "activationExpiry" => "testActivationExpiry",
            "activatedAt" => "testActivatedAt",
            "userProfileID" => "testuserProfileID"
        );

        $account = new Account($testData);

        $this->assertSame("testAccountID", $account->get("accountID"));
        $this->assertSame("testUserName", $account->get("username"));
        $this->assertSame("testEmail", $account->get("email"));
        $this->assertSame("testPassword", $account->get("password"));
        $this->assertSame(false, $account->get("isBetaUser"));
        $this->assertSame(false, $account->get("isActive"));
        $this->assertSame("testActivationCode", $account->get("activationCode"));
        $this->assertSame("testActivationExpiry", $account->get("activationExpiry"));
        $this->assertSame("testActivatedAt", $account->get("activatedAt"));
        $this->assertSame("testuserProfileID", $account->get("userProfileID"));
    }

    /**
     * @covers \Account::get
     */
    public function testGet(): void
    {
        // Associative array which contains the data used to instantiate the Account class
        $testData = array(
            "accountID" => "testAccountID",
            "username" => "testUserName",
            "email" => "testEmail",
            "password" => "testPasword",
            "isBetaUser" => false,
            "isActive" => false,
            "activationCode" => "testActivationCode",
            "activationExpiry" => "testActivationExpiry",
            "activatedAt" => "testActivatedAt",
            "userProfileID" => "testuserProfileID"
        );

        // Instantiate a new Account with the testData as its attribute values
        $account = new Account($testData);

        // Use the account method getAllAttributes which returns an associative array that contains the attributes and values of the object
        // Iterate over the object atributes and their values and for each key/attribute
        // call the get method on that key/attribute to get the attribute value, then compare both values
        foreach ($account->getAllAttributes() as $attr => $value) {
            $this->assertEquals($value, $account->get($attr));
        }
    }

    /**
     * @covers \Account::set
     */
    public function testSet(): void
    {
        // Associative array which contains the data used to instantiate the Account class
        $testData = array(
            "accountID" => "testAccountID",
            "username" => "testUserName",
            "email" => "testEmail",
            "password" => "testPasword",
            "isBetaUser" => false,
            "isActive" => false,
            "activationCode" => "testActivationCode",
            "activationExpiry" => "testActivationExpiry",
            "activatedAt" => "testActivatedAt",
            "userProfileID" => "testuserProfileID"
        );

        // Instantiate a new Account with the testData as its attribute values
        $account = new Account($testData);

        // Iterate over the object atributes and their values and for each key/attribute
        // use the account set method on that key to change the attribute value
        foreach ($account->getAllAttributes() as $key => $value) {

            // If the attribute type is of type boolean assign the value true, else assign a new string
            // subsequently we call the get method on that same key in order to compare both values
            if ($key === "isBetaUser" || $key === "isActive") {
                $account->set($key, true);
                $this->assertEquals(true, $account->get($key));
            } else {
                $account->set($key, "newTest" . ucfirst($key));
                $this->assertEquals("newTest" . ucfirst($key), $account->get($key));
            }
        }
    }

    /**
     * @covers \Account::getAllAttributes
     */
    public function testGetAllAttributes(): void
    {
        // Associative array which contains the data used to instantiate the Account class
        $testData = array(
            "accountID" => "testAccountID",
            "username" => "testUserName",
            "email" => "testEmail",
            "password" => "testPasword",
            "isBetaUser" => false,
            "isActive" => false,
            "activationCode" => "testActivationCode",
            "activationExpiry" => "testActivationExpiry",
            "activatedAt" => "testActivatedAt",
            "userProfileID" => "testuserProfileID"
        );

        // Instantiate a new Account with the testData as its attribute values
        $account = new Account($testData);

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
