<?php

use Model\Role;
use PHPUnit\Framework\TestCase;

require_once '../Playm8_mvc/model/Role.php';

class RoleTest extends TestCase
{
    public function testGet(): void
    {
        // Associative array which contains the data used to instantiate the Role class
        $testData = array(
            "roleID" => 1,
            "roleName" => "restRoleName",
            "roleDescription" => "testRoleDescription"
        );

        // Instantiate a new role with the testData as its attribute values
        $role = new Role($testData);

        // Use the role method getAllAttributes to get an associative array containing the object attributes and values
        // Iterate over the object atributes and their values and
        // for each attribute, use the role get method on that key to get the attribute value, then compare both values
        foreach ($role->getAllAttributes() as $attr => $value) {
            $this->assertEquals($value, $role->get($attr));
        }
    }

    public function testSet(): void
    {
        // Associative array which contains the data used to instantiate the Role class
        $testData = array(
            "roleID" => 1,
            "roleName" => "restRoleName",
            "roleDescription" => "testRoleDescription"
        );

        // Instantiate a new role with the testData as its attribute values
        $role = new Role($testData);

        // For each object attribute as the key in the role object, use the role set method on that key to change the attribute value
        foreach ($role->getAllAttributes() as $key => $value) {
            // If the attribute type is of type boolean assign the value true, else assign a new string
            // Then check if the value we get using the get method equals true
            if ($key === "roleID") {
                $role->set($key, 2);
                $this->assertEquals(2, $role->get($key));
            } else {
                $role->set($key, "newTest" . ucfirst($key));
                $this->assertEquals("newTest" . ucfirst($key), $role->get($key));
            }
        }
    }

    public function testGetAllAttributes(): void
    {
        // Associative array which contains the data used to instantiate the Role class
        $testData = array(
            "roleID" => 1,
            "roleName" => "restRoleName",
            "roleDescription" => "testRoleDescription"
        );

        // Instantiate a new Account with the testData as its attribute values
        $account = new Role($testData);

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
