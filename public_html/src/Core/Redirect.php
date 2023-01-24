<?php

namespace Triangle\Core;

class Redirect
{
    public static function go($url, $status_code = 303)
    {
        header('Location: ' . $url, true, $status_code);
        die();
    }
}
