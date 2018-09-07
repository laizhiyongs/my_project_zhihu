<?php

class Single
{

    public static $instance;

    /**
     * 构造方法是私有的，你就不能实列化
     * Single constructor.
     */
    private function __construct()
    {

    }


    public static function getinstance()
    {
        !self::$instance && self::$instance = new self();
        return self::$instance;
    }

}
