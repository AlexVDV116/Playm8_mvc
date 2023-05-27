<?php

use Model\Permission;
use PHPUnit\Framework\TestCase;

require_once '../Playm8_mvc/model/Permission.php';

final class PermissionTest extends TestCase
{

    public function testGet(): void
    {
        // Associative array which contains the data used to instantiate the Permission class
        $testData = array(
            "permissionID" => 1,
            "permissionName" => "testPermissionName",
            "permissionDescription" => "testPermissionDescription"
        );

        // Instantiate a new Permission with the testData as its attribute values
        $permission = new Permission($testData);

        // Use the permission method getAllAttributes to get an associative array containing the object attributes and values
        // Iterate over the object atributes and their values and
        // for each attribute, use the permission get method on that key to get the attribute value, then compare both values
        foreach ($permission->getAllAttributes() as $attr => $value) {
            $this->assertEquals($value, $permission->get($attr));
        }
    }

    public function testSet(): void
    {
        // Associative array which contains the data used to instantiate the Permission class
        $testData = array(
            "permissionID" => 1,
            "permissionName" => "testPermissionName",
            "permissionDescription" => "testPermissionDescription"
        );

        // Instantiate a new Permission with the testData as its attribute values
        $permission = new Permission($testData);

        // For each object attribute as the key in the permission object, use the permission set method on that key to change the attribute value
        foreach ($permission->getAllAttributes() as $key => $value) {
            // If the attribute type is of type boolean assign the value true, else assign a new string
            // Then check if the value we get using the get method equals true
            if ($key === "permissionID") {
                $permission->set($key, 2);
                $this->assertEquals(2, $permission->get($key));
            } else {
                $permission->set($key, "newTest" . ucfirst($key));
                $this->assertEquals("newTest" . ucfirst($key), $permission->get($key));
            }
        }
    }

    public function testGetAllAttributes(): void
    {
        // Associative array which contains the data used to instantiate the Permission class
        $testData = array(
            "permissionID" => 1,
            "permissionName" => "testPermissionName",
            "permissionDescription" => "testPermissionDescription"
        );

        // Instantiate a new Account with the testData as its attribute values
        $account = new Permission($testData);

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
