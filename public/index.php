<?php
require_once('../vendor/autoload.php');
(new \Dotenv\Dotenv(dirname(__DIR__)))->load();
$fs2 = (new App\DynamicKernel())->boot('App\Frogsystem2');
$fs2();
