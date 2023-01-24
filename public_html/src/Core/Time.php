<?php

namespace Triangle\Core;

class Time
{
    public static function create()
    {
        return new static();
    }

    public static function get($filename)
    {
        return date("Y-m-d H:i", filemtime($filename));
    }
}
