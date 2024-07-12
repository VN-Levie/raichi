<?php
// show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../system/AutoLoad.php';

use App\Models\User;
use System\DotEnv;

DotEnv::loadEnv();

$users = User::all();

echo "<pre>";
echo "num:" . $users->count() . "<br>";
print_r($users);
$iterator = $users->getIterator();
foreach ($users as $user) {
    
    echo $user->username . "<br>";
}
// print_r($_ENV);
echo "</pre>";
//$run ->;
