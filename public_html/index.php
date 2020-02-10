<?php

date_default_timezone_set( getenv('TZ') );

require 'vendor/kint.php';
require 'vendor/autoload.php';

echo Triangle\Core\Router::create()->deliverPage();

// echo 'Hello World!';
