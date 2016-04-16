<?php
require_once('../vendor/autoload.php');
(new \Dotenv\Dotenv(dirname(__DIR__)))->load();
(new \App\Frogsystem2())->__invoke();
