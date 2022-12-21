<?php

// Multidimensional associative array which acts as a mock database holding account data
$data = [
    ['accountID' => 'TAID63a1ccc382267', 'email' => 'testeamail1@email.com', 'password' => 'secret01!', 'enabled' => true, 'roles' => [], 'isLoggedIn' => false],
    ['accountID' => 'TAID52b2ddd234751', 'email' => 'testeamail2@email.com', 'password' => 'secret02!', 'enabled' => true, 'roles' => [], 'isLoggedIn' => false],
    ['accountID' => 'TAID41c3eee256863', 'email' => 'testeamail3@email.com', 'password' => 'secret03!', 'enabled' => true, 'roles' => [], 'isLoggedIn' => false],
];

echo "<pre>";
var_dump($data);
echo "</pre>";
