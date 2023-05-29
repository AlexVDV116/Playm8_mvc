<?php

// Define the namespace of this class
namespace Controller;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

global $lang;
global $ROOT;

require_once $ROOT . 'assets/languages/nl.php';
require_once $ROOT . 'assets/languages/en.php';
require_once $ROOT . 'assets/languages/es.php';
require_once $ROOT . 'assets/languages/fr.php';
require_once $ROOT . 'assets/languages/zh.php';

class translatorController
{
    // Function that gets the language set from the session variable or trough the GET method and returns the correct language file
    public function getLanguageFile(): string
    {
        // ?? Null coalescing operator
        // Check if we have a session variable 'lang' set, if true set it to itself, else set defaut value to 'en'
        $_SESSION['lang'] = $_SESSION['lang'] ?? 'en';

        // Check if we have a language set trough the GET method, if true set it to the GET value, else set to session 'lang' value
        $_SESSION['lang'] = $_GET['lang'] ?? $_SESSION['lang'];

        // Return the correct language file
        return './assets/languages/' . $_SESSION['lang'] . '.php';
    }

    // Function that translates a given string 
    public function __($str): string
    {
        global $lang;
        // If there is an item in lang that corresponds to to the given string, return the translated value
        if (array_key_exists($str, $lang)) {
            return $lang[$str];
        }

        // Else return the given string
        return $str;
    }
}
