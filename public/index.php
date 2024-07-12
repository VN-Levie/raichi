<?php

// show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../system/AutoLoad.php';

use System\DotEnv;

DotEnv::loadEnv();

echo "<pre>";
print_r($_ENV);
echo "</pre>";
