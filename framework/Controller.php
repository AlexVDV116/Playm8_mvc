<?php

abstract class Controller
{

    abstract function run();

    public function __construct()
    {
        header('Content-type: text/plain'); // make sql-errors readable
        $next = $this->run();
        if (!Dbh::$debug) {
            header('location: ?' . $next);
        }
        exit;
    }
}
