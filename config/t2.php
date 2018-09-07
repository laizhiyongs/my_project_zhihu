<?php

class DB
{

    static $instance;

    private function __construct()
    {
    }

    static function getinstance()
    {
        !self::$instance && self::$instance = new self();
        return self::$instance;
    }
}

DB::getinstance();
DB::getinstance();