<?php

// Define the namespace of this class
namespace Framework;

abstract class Controller
{

    abstract function run();

    public function __construct()
    {
        header('Content-type: text/plain'); // make sql-errors readable
        $next = $this->run();
        if (!databaseHandler::$debug) {
            header('location: ?' . $next);
        }
        exit;
    }
}
