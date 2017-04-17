<?php

$dbserver = "localhost";
$dbname = 'hlounpost2';
$dbusername = "root";
$dbpassword = "root";


### PLEASE DONT EDIT ANYTHING #####
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . $dbserver . ';dbname=' . $dbname,
    'username' => $dbusername,
    'password' => $dbpassword,
    'charset' => 'utf8',
];
